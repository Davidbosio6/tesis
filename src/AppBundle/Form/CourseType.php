<?php

namespace AppBundle\Form;

use AppBundle\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class CourseType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('school', TextType::class)
            ->add('startAt', DateType::class, [
                'html5' => true,
                'widget' => 'single_text'
            ])
            ->add('endAt', DateType::class, [
                'html5' => true,
                'widget' => 'single_text'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'courses';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class
        ]);
    }
}
