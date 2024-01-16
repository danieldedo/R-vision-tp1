<?php

namespace App\Form;

use App\Entity\Voyageur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VoyageurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Nom',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('prenom',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Prenom',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('ville',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Ville',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('region',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Region',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('sexe',ChoiceType::class , [
                'choices' => [
                    'Masculin'=> 'Masculin',
                    'Feminin' => 'Feminin'
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Sexe',
                'attr' => ['class' => 'form-check-input',],
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyageur::class,
        ]);
    }
}
