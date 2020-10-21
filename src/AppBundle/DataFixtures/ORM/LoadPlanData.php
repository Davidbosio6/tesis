<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Plan;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;


class LoadPlanData extends AbstractFixture implements FixtureInterface
{
    const PLAN_BASICO = 'p_plan_basico';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $plan = new Plan();
        $plan->setName('Beca 100%');
        $plan->setDescription('Beca municipal');
        $plan->setValue(0);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Beca 50%');
        $plan->setDescription('Beca municipal');
        $plan->setValue(500);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Plan Básico');
        $plan->setDescription('Beca municipal');
        $plan->setValue(1000);
        $this->addReference(self::PLAN_BASICO, $plan);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Plan Intermedio');
        $plan->setDescription('Plan Intermedio');
        $plan->setValue(1500);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Beca Premium');
        $plan->setDescription('Plan Intermedio');
        $plan->setValue(2000);
        $manager->persist($plan);

        $manager->flush();
    }
}
