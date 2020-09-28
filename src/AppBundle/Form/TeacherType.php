<?php
namespace AppBundle\Form;

use AppBundle\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class TeacherType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label'=> 'Nombre'])
            ->add('lastName', TextType::class, ['label'=> 'Apellido'])
            ->add('user', UserType::class, ['label'=> false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class
        ]);
    }
}
