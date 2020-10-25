<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadSubjectData extends AbstractFixture implements FixtureInterface
{
    const DIBUJO = 's_dibujo';
    const MUSICA = 's_musica';
    const DYA = 's_desarrollo_y_aprendizaje';
    const LYC = 's_lenguaje_y_comunicacion';
    const LECTURA = 's_lectura';
    const EF = 's_educacion_fisica';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $subject = new Subject();
        $subject->setName('Dibujo');
        $manager->persist($subject);
        $this->addReference(self::DIBUJO, $subject);

        $subject = new Subject();
        $subject->setName('Desarrollo y aprendizaje');
        $manager->persist($subject);
        $this->addReference(self::DYA, $subject);

        $subject = new Subject();
        $subject->setName('Música');
        $manager->persist($subject);
        $this->addReference(self::MUSICA, $subject);

        $subject = new Subject();
        $subject->setName('Lenguaje y Comunicación');
        $manager->persist($subject);
        $this->addReference(self::LYC, $subject);

        $subject = new Subject();
        $subject->setName('Lectura');
        $manager->persist($subject);
        $this->addReference(self::LECTURA, $subject);

        $subject = new Subject();
        $subject->setName('Educación Física');
        $manager->persist($subject);
        $this->addReference(self::EF, $subject);

        $manager->flush();
    }
}
