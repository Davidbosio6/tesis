<?php

namespace AppBundle\Form;

use AppBundle\Entity\Classroom;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ClassroomType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SelectClassroomType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('classrooms',
            EntityType::class, [
                'class' => Classroom::class,
                'placeholder' => '--- Seleccionar Sala ---',
                'choice_label' => 'name',
                'required' => true,
                'attr' => ['min' => 1]
            ]
        )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'classrooms';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
