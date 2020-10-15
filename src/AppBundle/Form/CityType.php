<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Province;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class CityType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label'=> 'Nombre'])
            ->add('postalCode', TextType::class, ['label'=> 'Código Postal'])
            ->add('province', EntityType::class, [
                'class' => Province::class,
                'label' => 'Provincia',
                'placeholder' => '-- Seleccione una provincia --',
                'choice_label' => 'name',
                'group_by' => function (Province $province) {
                    return $province->getCountry()->getName();
                }
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
