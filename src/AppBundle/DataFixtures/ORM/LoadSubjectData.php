<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Subject;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadSubjectData extends AbstractFixture implements FixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $subject = new Subject();
        $subject->setName('Dibujo');
        $manager->persist($subject);

        $subject = new Subject();
        $subject->setName('Desarrollo y aprendizaje');
        $manager->persist($subject);

        $subject = new Subject();
        $subject->setName('Música');
        $manager->persist($subject);

        $subject = new Subject();
        $subject->setName('Lenguaje y Comunicación');
        $manager->persist($subject);

        $subject = new Subject();
        $subject->setName('Lectura');
        $manager->persist($subject);

        $subject = new Subject();
        $subject->setName('Educación Física');
        $manager->persist($subject);

        $manager->flush();
    }
}
