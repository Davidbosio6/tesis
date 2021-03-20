<?php

namespace AppBundle\Form;

use AppBundle\Entity\Advisor;
use AppBundle\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SelectEmailType.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SelectEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Student $student */
        $student = $options['student'];
        $builder
            ->add(
                'advisor',
                ChoiceType::class, [
                    'placeholder' => '-- Seleccione un tutor --',
                    'choices' => $this->getAdvisorsOptions($student)
                ]
            );
    }

    /**
     * @param Student $student
     *
     * @return array
     */
    private function getAdvisorsOptions(Student $student): array
    {
        $output = [];
        /** @var Advisor $advisor */
        foreach ($student->getAdvisors() as $advisor) {
            $output[$advisor->getFullName() . " - " . $advisor->getEmail()] = $advisor->getId();
        }

        return $output;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);

        $resolver->setRequired('student');
    }
}
