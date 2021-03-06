<?php

namespace AppBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class CodeIdType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class CodeIdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeId', TextType::class, [
                'attr' => [
                    'placeholder' => 'ID Alumno',
                    'autocomplete' => 'off',
                ]
            ])
            ->add('captcha', CaptchaType::class, [
                'attr' => ['class' => 'captcha']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
