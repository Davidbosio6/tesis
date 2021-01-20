<?php

namespace AppBundle\Form;

use AppBundle\Entity\ProgressHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ProgressHistoryType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class ProgressHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tittle', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titulo'
                ]
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'placeholder' => 'Descripción del Progreso'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProgressHistory::class
        ]);
    }
}
