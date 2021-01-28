<?php

namespace AppBundle\Form;

use AppBundle\Entity\Classroom;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Student;
use AppBundle\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class SignUpType.
 *
 * @DI\Service("app.form.sign_up_type")
 * @DI\Tag("form.type")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SignUpType extends AbstractType
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @DI\InjectParams({
     *     "em" = @DI\Inject("doctrine.orm.entity_manager"),
     * })
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('advisors', CollectionType::class, [
                'entry_type' => AdvisorType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_options' => [
                    'label' => false,
                ],
                'by_reference' => false,
                'attr' => ['class' => 'advisors']
            ])
            ->add('classroom', ChoiceType::class, [
                'placeholder' => '-- Seleccione una sala --',
                'choices' => $this->getChoices()
            ])
            ->add('plan', EntityType::class, [
                'class' => Plan::class,
                'choice_label' => 'name'
            ])
            ->add('generateInstallments', ChoiceType::class, [
                'choices' => [
                    'Si' => 1,
                    'No' => 0
                ]
            ])
            ->add('photo', FileType::class, [
                'required' => false,
                'mapped' => false
            ])
            ->add('medicalHistory', MedicalHistoryType::class, [
                'action' => $options['mode']
            ]);
    }

    private function getChoices(): array
    {
        /** @var ClassroomRepository $classroomRepository */
        $classroomRepository = $this->em->getRepository(Classroom::class);

        $output = [];
        /** @var Classroom $classroom */
        foreach ($classroomRepository->findAll() as $classroom) {
            if ($classroom->getCapacity() > $classroom->getStudents()->count()) {
                $output[$classroom->getShift()->getName() . " - " . $classroom->getName()] = $classroom->getId();
            }
        }

        return $output;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class
        ]);

        $resolver->setRequired([
            'mode'
        ]);
    }
}
