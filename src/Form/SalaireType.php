<?php

namespace App\Form;

use App\Entity\Salaire;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('periodesalaire', EntityType::class, [
                'label'=> 'Période de cours',
                'attr'=>[
                    'class'=>'select2 form-control',
                ],
                'query_builder'=>function(EntityRepository $er): QueryBuilder{
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.username', 'ASC');
                },


            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salaire::class,
        ]);
    }
}
