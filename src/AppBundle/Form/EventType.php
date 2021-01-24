<?php

namespace AppBundle\Form;

use AppBundle\Entity\Event;
use AppBundle\Entity\Subject;
use AppBundle\Entity\Teacher;
use AppBundle\Repository\SubjectRepository;
use AppBundle\Repository\TeacherRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Class EventType.
 *
 * @DI\Service("app.form.event_type")
 * @DI\Tag("form.type")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class EventType extends AbstractType
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
                'name',
                ChoiceType::class,
                [
                    'placeholder' => '--- Seleccione un nombre ---',
                    'choices' => $this->getChoices()
                ]
            )
            ->add('startHour', TimeType::class,
                [
                    'html5' => true,
                    'widget' => 'single_text'
                ]
            )
            ->add('endHour', TimeType::class,
                [
                    'html5' => true,
                    'widget' => 'single_text'
                ]
            )
        ;
    }

    private function getChoices(): array
    {
        /** @var TeacherRepository $teacherRepository */
        $teacherRepository = $this->em->getRepository(Teacher::class);

        $output = [];
        /** @var Teacher $teacher */

        $output['Libre'] = 'Libre';
        foreach ($teacherRepository->findAll() as $teacher) {
            $output[$teacher->getSubject()->getName() . " - " . $teacher->getFullName()] = $teacher->getSubject()->getName() . " - " . $teacher->getFullName();
        }

        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'events';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class
        ]);
    }
}
