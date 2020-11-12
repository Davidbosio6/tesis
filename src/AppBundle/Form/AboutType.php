<?php

namespace AppBundle\Form;

use AppBundle\Entity\About;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class AboutType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class AboutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tittle', TextType::class)
            ->add('content', TextareaType::class)
            ->add('showAbout', ChoiceType::class, [
                'choices' => [
                    'No' => 0,
                    'Si' => 1
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => About::class
        ]);
    }
}
