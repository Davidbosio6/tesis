<?php

namespace AppBundle\Form;

use AppBundle\Entity\Student;
use AppBundle\Repository\StudentRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class StudentPreSignUpType.
 *
 * @DI\Service("app.form.select_user_for_sign_up_type")
 * @DI\Tag("form.type")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class SelectUserForSignUpType extends AbstractType
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
            ->add(
                'student',
                ChoiceType::class,
                [
                    'placeholder' => '--- Seleccionar Alumno ---',
                    'choices' => $this->getChoices()
                ]
            )
        ;
    }

    private function getChoices(): array
    {
        /** @var StudentRepository $studentRepository */
        $studentRepository = $this->em->getRepository(Student::class);

        $output = [];
        /** @var Student $student */
        foreach ($studentRepository->findAll() as $student) {
            if (empty($student->getClassroom())) {
                $output[$student->getIdNumber() . " - " . $student->getFullName()] = $student->getId();
            }
        }

        return $output;
    }
}
