<?php

namespace AppBundle\Form;

use AppBundle\Entity\MedicalHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class MedicalHistoryType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class MedicalHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight', TextType::class)
            ->add('height', TextType::class)
            ->add('bloodType', TextType::class)
            ->add('allergy', TextareaType::class, ['required' => false])
            ->add('chronicIllness', TextareaType::class, ['required' => false])
            ->add('medicine', TextareaType::class, ['required' => false])
            ->add('asma', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true
            ])
            ->add('sinusitis', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true,
            ])
            ->add('bronquitis', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true,
            ])
            ->add('otitis', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true,
            ])
            ->add('tosConvulsiva', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true,
            ])
            ->add('migrania', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true,
            ])
            ->add('diabetes', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true,
            ])
            ->add('celiaco', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ],
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicalHistory::class
        ]);
    }
}
