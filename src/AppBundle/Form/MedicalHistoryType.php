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
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true
            ])
            ->add('sinusitis', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true,
            ])
            ->add('bronquitis', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true,
            ])
            ->add('otitis', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true,
            ])
            ->add('tosConvulsiva', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true,
            ])
            ->add('migrania', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true,
            ])
            ->add('diabetes', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true,
            ])
            ->add('celiaco', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ],
                'expanded' => true,
            ])
        ;

        if ($options['action'] === 'create') {
            $builder->get('asma')->setData(0);
            $builder->get('sinusitis')->setData(0);
            $builder->get('bronquitis')->setData(0);
            $builder->get('otitis')->setData(0);
            $builder->get('tosConvulsiva')->setData(0);
            $builder->get('migrania')->setData(0);
            $builder->get('diabetes')->setData(0);
            $builder->get('celiaco')->setData(0);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicalHistory::class
        ]);
    }
}
