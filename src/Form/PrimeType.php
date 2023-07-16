<?php

namespace App\Form;

use App\Entity\Prime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label'=> 'Nom prime',
                'attr'=>[
                    'placeholder'=>"Entrez une prime",
                    'class'=>"form-control",
                ],

            ])
            ->add('somme',IntegerType::class,[
                'label'=> 'Montant prime',
                'attr'=>[
                    'placeholder'=>"1000 , 10000 ,....",
                    'class'=>"form-control",
                    'min'=>0,
                ],

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prime::class,
        ]);
    }
}
