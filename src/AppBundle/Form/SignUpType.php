<?php

namespace AppBundle\Form;

use AppBundle\Entity\Classroom;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SignUpType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SignUpType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('advisors', CollectionType::class, [
                'entry_type' => AdvisorType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => [
                    'label' => false,
                ],
                'by_reference' => false,
                'attr' => ['class' => 'advisors']
            ])
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'name',
                'placeholder' => '-- Seleccione una sala --',
                'group_by' => function (Classroom $classroom) {
                    return $classroom->getShift()->getName();
                }
            ])
            ->add('plan', EntityType::class, [
                'class' => Plan::class,
                'placeholder' => '-- Seleccione un plan --',
                'choice_label' => 'name'
            ])
            ->add('generateInstallments', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ]
            ])
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false
            ])
            ->add('medicalHistory', MedicalHistoryType::class, [
                'action' => $options['mode']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class
        ]);

        $resolver->setRequired([
            'mode'
        ]);
    }
}
