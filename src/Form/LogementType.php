<?php

namespace App\Form;

use App\Entity\Logement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class LogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code',TextType::class , [
                'attr' => ['class' => 'form-control'],
                'label' => 'Code',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('nom',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Nom',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('capacite',IntegerType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Capacite',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('type',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Type',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('lieu',TextType::class , [
                'attr' => ['class' => 'form-control',],
                'label' => 'Lieu',
                'label_attr' => ['class' => 'form-label mt-4'],
            ])
            ->add('photo', FileType::class, [
                'attr'=> ['class' => 'form-control'],
                'mapped' => false,
                'required' => false,
                'label' => 'Photo',
                'label_attr' => ['class' => 'form-label mt-4'],
                // 'constraints' => [
                    // new File([
                        // 'maxSize' => '1024k',
                        // 'mimeTypes' => [
                        //     'application/pdf',
                        //     'application/x-pdf',
                        // ],
                        // 'mimeTypesMessage' => 'Please upload a valid PDF document',
                    // ])
                // ],
            ])
            ->add('disponibilite',CheckboxType::class , [
                'attr' => ['class' => 'form-check-input ', 'role'=>'switch'],
                'required' => false,
                'label' => 'Disponibilite',
                'label_attr' => ['class' => 'form-check-label'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Logement::class,
        ]);
    }
}
