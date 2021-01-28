<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Course;
use AppBundle\Entity\Teacher;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadCourseData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadCourseData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Teacher $teacher1 */
        $teacher1 = $this->getReference(LoadTeacherData::TEACHER_1);
        /** @var Teacher $teacher2 */
        $teacher2 = $this->getReference(LoadTeacherData::TEACHER_2);
        /** @var Teacher $teacher3 */
        $teacher3 = $this->getReference(LoadTeacherData::TEACHER_3);
        /** @var Teacher $teacher4 */
        $teacher4 = $this->getReference(LoadTeacherData::TEACHER_4);
        /** @var Teacher $teacher5 */
        $teacher5 = $this->getReference(LoadTeacherData::TEACHER_5);
        /** @var Teacher $teacher6 */
        $teacher6 = $this->getReference(LoadTeacherData::TEACHER_6);

        $course = new Course();
        $course->setName('Licenciatura en Artes Visuales');
        $course->setStartAt(new DateTime('+1 week -2 months -10 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -5 years'));
        $course->setSchool('Facultad de Artes - UNC');
        $course->setTeacher($teacher1);
        $manager->persist($course);

        $course = new Course();
        $course->setName('Profesorado en Educación Plástica y Visual');
        $course->setStartAt(new DateTime('+1 week -2 months -5 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -2 years'));
        $course->setSchool('Facultad de Artes - UNC');
        $course->setTeacher($teacher1);
        $manager->persist($course);

        $course = new Course();
        $course->setName('Profesorado de Música');
        $course->setStartAt(new DateTime('+1 week -2 months -6 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -2 years'));
        $course->setSchool('Conservatorio Superior de Música "Julián Aguirre" - Rio Cuarto');
        $course->setTeacher($teacher2);
        $manager->persist($course);

        $course = new Course();
        $course->setName('Profesorado de Educacion Fisica');
        $course->setStartAt(new DateTime('+1 week -2 months -6 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -2 years'));
        $course->setSchool('Uiversidad Sigo 21');
        $course->setTeacher($teacher3);
        $manager->persist($course);

        $course = new Course();
        $course->setName('Profesorado de Educacion Fisica');
        $course->setStartAt(new DateTime('+1 week -2 months -6 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -2 years'));
        $course->setSchool('Uiversidad Sigo 21');
        $course->setTeacher($teacher4);
        $manager->persist($course);

        $course = new Course();
        $course->setName('Comunicación Social');
        $course->setStartAt(new DateTime('+1 week -2 months -8 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -3 years'));
        $course->setSchool('Facultad de Ciencias de la Comunicación - UNC');
        $course->setTeacher($teacher5);
        $manager->persist($course);

        $course = new Course();
        $course->setName('Lic. en Español Lengua Materna y Lengua Extranjera');
        $course->setStartAt(new DateTime('+1 week -2 months -8 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -4 years'));
        $course->setSchool('Facultad de Lenguas - UNC');
        $course->setTeacher($teacher6);
        $manager->persist($course);

        $course = new Course();
        $course->setName('Doctorado en Ciencias del Lenguaje');
        $course->setStartAt(new DateTime('+1 week -2 months -4 years'));
        $course->setEndAt(new DateTime('+1 week -2 months -1 years'));
        $course->setSchool('Facultad de Lenguas - UNC');
        $course->setTeacher($teacher6);
        $manager->persist($course);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadTeacherData::class,
        ];
    }
}
