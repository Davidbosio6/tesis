<?php

namespace AppBundle\Form;

use AppBundle\Entity\Calendar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class CalendarType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('googleId', TextType::class)
            ->add('events', CollectionType::class, [
                'entry_type' => EventType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => [
                    'label' => false,
                    'startHour' => $options['startHour'],
                    'endHour' => $options['endHour'],
                ],
                'by_reference' => false,
                'attr' => ['class' => 'events'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class
        ]);

        $resolver->setRequired('startHour');
        $resolver->setRequired('endHour');
    }
}
