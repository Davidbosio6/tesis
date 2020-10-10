<?php

namespace AppBundle\Form;

use AppBundle\Entity\Shift;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ShiftType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class ShiftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=> 'Año'])
            ->add('startHour', TimeType::class,
                [
                    'label'=> 'Hora de inicio',
                    'html5' => true,
                    'widget' => 'single_text'
                ]
            )
            ->add('endHour', TimeType::class,
                [
                    'label' => 'Hora de fin',
                    'html5' => true,
                    'widget' => 'single_text'
                ]
            )
            ->add('notes', TextareaType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shift::class
        ]);
    }
}
