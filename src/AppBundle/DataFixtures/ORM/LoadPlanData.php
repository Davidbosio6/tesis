<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Plan;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadPlanData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
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
        $plan->setDescription1('-');
        $plan->setDescription2('-');
        $plan->setAmount(0);
        $plan->setShowPlan(false);
        $plan->setIsHighLighted(false);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Beca 50%');
        $plan->setDescription('Beca municipal');
        $plan->setDescription1('-');
        $plan->setDescription2('-');
        $plan->setAmount(500);
        $plan->setShowPlan(false);
        $plan->setIsHighLighted(false);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Plan Básico');
        $plan->setDescription('Merienda incluida.');
        $plan->setDescription1('-');
        $plan->setDescription2('-');
        $plan->setAmount(1000);
        $plan->setShowPlan(true);
        $plan->setIsHighLighted(false);
        $this->addReference(self::PLAN_BASICO, $plan);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Plan Intermedio');
        $plan->setDescription('Merienda incluida.');
        $plan->setDescription1('Seguimiento personalizado.');
        $plan->setDescription2('-');
        $plan->setAmount(1500);
        $plan->setShowPlan(true);
        $plan->setIsHighLighted(false);
        $manager->persist($plan);

        $plan = new Plan();
        $plan->setName('Plan Premium');
        $plan->setDescription('Merienda incluida.');
        $plan->setDescription1('Seguimiento personalizado.');
        $plan->setDescription2('Acompañamiento docente permanente.');
        $plan->setAmount(2000);
        $plan->setShowPlan(true);
        $plan->setIsHighLighted(true);
        $manager->persist($plan);

        $manager->flush();
    }
}
