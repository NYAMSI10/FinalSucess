<?php

namespace App\Form;

use App\Entity\Classe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label'=> 'Nom classe',
                'attr'=>[
                    'placeholder'=>"Entrez une classe",
                    'class'=>"form-control",
                ],

            ])
            ->add('frais',IntegerType::class,[
                'label'=> 'Frais de cours',
                'attr'=>[
                    'placeholder'=>"5000 , 10000 ,....",
                    'class'=>"form-control",
                    'min'=>0,

                ],

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
