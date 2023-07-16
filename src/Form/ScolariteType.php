<?php

namespace App\Form;

use App\Entity\Scolarite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScolariteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avance',IntegerType::class,[
                'label'=> 'Montant d\'avancement ou Total',
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
            'data_class' => Scolarite::class,
        ]);
    }
}
