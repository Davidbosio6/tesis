<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Province;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=> 'Nombre'])
            ->add('province', EntityType::class, [
                'class' => Province::class,
                'choice_label' => 'name',
                'label' => 'Provincia'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class
        ]);
    }
}
