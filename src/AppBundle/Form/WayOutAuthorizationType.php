<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class WayOutAuthorizationType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class WayOutAuthorizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('when', DateType::class, [
                'html5' => true,
                'widget' => 'single_text'
            ])
            ->add('where', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ej: la Estación de Bomberos Voluntarios',
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ej: Primera Junta 1230',
                ]
            ])
            ->add('startHour', TimeType::class,
                [
                    'html5' => true,
                    'widget' => 'single_text'
                ]
            )
            ->add('endHour', TimeType::class,
                [
                    'html5' => true,
                    'widget' => 'single_text'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
