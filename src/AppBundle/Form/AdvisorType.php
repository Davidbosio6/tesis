<?php

namespace AppBundle\Form;

use AppBundle\Entity\Advisor;
use AppBundle\Entity\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class AdvisorType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class AdvisorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class)
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
            ->add('studentRelationship', ChoiceType::class, [
                'placeholder' => '-- Seleccione una --',
                'choices' => $this->getStudentRelationship()
            ])
            ->add('address', TextType::class)
            ->add('notes', TextareaType::class, ['required' => false])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'advisors';
    }

    public function getStudentRelationship()
    {
        return [
            'Madre' => 'Madre',
            'Padre' => 'Padre',
            'Hermana/o' => 'Hermana/o'
        ];
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advisor::class
        ]);
    }
}
