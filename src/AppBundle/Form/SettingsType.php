<?php

namespace AppBundle\Form;

use AppBundle\Entity\Settings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class SettingsType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, [ 'attr' => array(
            'readonly' => true,
        )]);
        $builder->add('value', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Settings::class
        ]);
    }
}
