<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\About;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;


class LoadAboutData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $about = new About();
        $about->setTittle('Misión');
        $about->setShowAbout(true);
        $manager->persist($about);

        $about = new About();
        $about->setTittle('Visión');
        $about->setShowAbout(true);
        $manager->persist($about);

        $about = new About();
        $about->setTittle('Objetivos');
        $about->setShowAbout(true);
        $manager->persist($about);

        $manager->flush();
    }
}
