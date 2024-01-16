<?php

namespace App\Form;

use App\Entity\Sejour;
use App\Entity\Logement;
use App\Entity\Voyageur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SejourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('debut', DateType::class, [
                'widget' => 'single_text',
             //'format' => 'yyyy-MM-dd',
            'attr' => ['class' => 'form-control']
        ])
            ->add('fin', DateType::class, [
                'widget' => 'single_text',
             //'format' => 'yyyy-MM-dd',
            'attr' => ['class' => 'form-control']
        ])
            ->add('voyageur', EntityType::class, [
                'placeholder' => 'Sélectionnez le voyageur',
                'class' => Voyageur::class,
                'choice_label' => function (Voyageur $voyageur) {
                    return $voyageur->getPrenom() . ' ' . $voyageur->getNom();
                },
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => 'Voyageur',
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('logement', EntityType::class, [
                'placeholder' => 'Sélectionnez le logement',
                'class' => Logement::class,
                'choice_label' => 'nom',
                'attr' => ['class' => 'form-control'],
                'required' => true,
                'label' => 'Logement',
                'label_attr' => ['class' => 'form-label'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sejour::class,
        ]);
    }
}
