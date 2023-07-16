<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label'=> 'Nom evènement',
                'attr'=>[
                    'placeholder'=>"Entrez une prime",
                    'class'=>"form-control",
                ],

            ])
            ->add('somme',IntegerType::class,[
                'label'=> 'Montant evènement',
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
            'data_class' => Evenement::class,
        ]);
    }
}
