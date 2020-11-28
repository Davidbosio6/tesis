<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Classroom;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class StudentType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('idNumber', NumberType::class)
            ->add('address', TextType::class)
            ->add('notes', TextareaType::class, ['required' => false])
            ->add('birthDate', DateType::class, [
                'html5' => true,
                'widget' => 'single_text'
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name',
                'placeholder' => '-- Seleccione una localidad --',
                'group_by' => function (City $city) {
                    return $city->getProvince()->getName();
                }
            ])
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
                'choice_label' => 'name'
            ])
            ->add('address', TextType::class)
            ->add('notes', TextareaType::class, ['required' => false])
            ->add('sex', ChoiceType::class, [
                'choices' => [
                    'Femenino' => 'Femenino',
                    'Masculino' => 'Masculino',
                    'No define' => 'No define'

                ]
            ])
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false
            ])
            ->add('medicalHistory', MedicalHistoryType::class, [
                'action' => $options['mode']
            ])
        ;

        if ($options['mode'] === 'create') {
            $builder->add('generateInstallments', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ]
            ]);
        }
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
