<?php

namespace AppBundle\Form;

use AppBundle\Entity\Shift;
use AppBundle\Entity\Year;
use AppBundle\Repository\ShiftRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class YearType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class YearType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class);

        if ($options['mode'] === 'create') {
            $builder->add('shifts', EntityType::class, [
                'class' => Shift::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (ShiftRepository $shiftRepository) {
                    return $shiftRepository->findAllWithoutYear();
                }
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Year::class
        ]);

        $resolver->setRequired([
            'mode'
        ]);
    }
}
