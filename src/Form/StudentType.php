<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Matiere;
use App\Entity\Periode;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => "Entrez un nom",
                    'class' => "form-control",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),

                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => "Entrez un prénom",
                    'class' => "form-control",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),

                ],
            ])
            ->add('inscription', IntegerType::class, [
                'label' => 'Frais Inscription',
                'attr' => [
                    'placeholder' => "1000,20000,...",
                    'class' => "form-control",
                    'min' => 0,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),

                ],
            ])
            ->add('quartier', TextType::class, [
                'label' => 'Quartier',

                'attr' => [
                    'placeholder' => "Entrez un quartier",
                    'class' => "form-control",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),

                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone du parent ou élève ',
                'attr' => [
                    'placeholder' => "Entrez un numéro de téléphone",
                    'class' => "form-control",
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),

                ],
            ])
            ->add('userperiode', EntityType::class, [

                'label' => 'Période',
                'class' => Periode::class,
                'choice_label' => 'name',
                'required' => true,
                'attr' => [
                    'class' => 'select2 form-control',
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),

                ],

            ])
            ->add('userclasse', EntityType::class, [

                'label' => 'Classe',
                'class' => Classe::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'select2 form-control',
                ],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Champ obligatoire',
                    ]),

                ],
            ])

         ->add('school', TextType::class, [
             'label' => 'Etablissement',
             'attr' => [
                 'placeholder' => "Entrez un établissement",
                 'class' => "form-control",
             ],
             'constraints' => [
                 new NotBlank([
                     'message' => 'Champ obligatoire',
                 ]),

             ],
         ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
