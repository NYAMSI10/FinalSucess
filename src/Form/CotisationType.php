<?php

namespace App\Form;

use App\Entity\Cotisation;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CotisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('somme', IntegerType::class, [
                'label' => 'Somme à cotiser',
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

            ->add('usercotisation', EntityType::class, [

                'label' => 'Nom enseignant',
                'class' => User::class,
                'choice_label' => 'firstname',
                'required' => true,
                'query_builder'=> function (EntityRepository $er){

                        return $er->createQueryBuilder('u')
                                ->andWhere('u.IsTeacher = 1');

                },
                'attr' => [
                    'class' => 'select2 form-control',
                ],
                'mapped' => false,


            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cotisation::class,
        ]);
    }
}
