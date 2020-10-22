<?php

namespace AppBundle\Form;

use AppBundle\Entity\Plan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class PlanType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class PlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('amount', NumberType::class)
            ->add('showPlan', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1

                ]
            ])
            ->add('isHighlighted', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plan::class
        ]);
    }
}
