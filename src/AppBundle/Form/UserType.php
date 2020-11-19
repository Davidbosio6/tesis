<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class UserType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class);


        if ($options['action'] === 'create') {
            $builder->add('plainPassword', PasswordType::class)
            ->add('roles', ChoiceType::class, [
                'placeholder' => '-- Seleccione una opción --',
                'choices' => [
                    'No' => 'ROLE_USER',
                    'Si' => 'ROLE_USER,ROLE_ADMIN'

                ]
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
