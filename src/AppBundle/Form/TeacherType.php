<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Subject;
use AppBundle\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class TeacherType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('idNumber', NumberType::class)
            ->add('birthDate', DateType::class, [
                'html5' => true,
                'widget' => 'single_text'
            ])
            ->add('phoneNumber', NumberType::class)
            ->add('city', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name',
                'placeholder' => '-- Seleccione una localidad --',
                'group_by' => function (City $city) {
                    return $city->getProvince()->getName();
                }
            ])
            ->add('address', TextType::class)
            ->add('notes', TextareaType::class, ['required' => false])
            ->add('user', UserType::class, [
                'action' => $options['mode']
            ])
            ->add('subject', EntityType::class, [
                'class' => Subject::class,
                'placeholder' => '-- Seleccione una asignatura --',
                'choice_label' => 'name'
            ])
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class
        ]);

        $resolver->setRequired([
            'mode'
        ]);
    }
}
