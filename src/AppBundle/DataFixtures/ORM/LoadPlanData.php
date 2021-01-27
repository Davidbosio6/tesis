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
    const PLAN_BECA_100 = 'p_beca_100';
    const PLAN_BECA_50 = 'p_beca_50';
    const PLAN_BASICO = 'p_plan_basico';
    const PLAN_INTERMEDIO = 'p_plan_intermedio';
    const PLAN_PREMIUM = 'p_plan_premium';

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
        $this->addReference(self::PLAN_BECA_100, $plan);

        $plan = new Plan();
        $plan->setName('Beca 50%');
        $plan->setDescription('Beca municipal');
        $plan->setDescription1('-');
        $plan->setDescription2('-');
        $plan->setAmount(500);
        $plan->setShowPlan(false);
        $plan->setIsHighLighted(false);
        $manager->persist($plan);
        $this->addReference(self::PLAN_BECA_50, $plan);

        $plan = new Plan();
        $plan->setName('Plan Básico');
        $plan->setDescription('Merienda incluida.');
        $plan->setDescription1('-');
        $plan->setDescription2('-');
        $plan->setAmount(1000);
        $plan->setShowPlan(true);
        $plan->setIsHighLighted(false);
        $manager->persist($plan);
        $this->addReference(self::PLAN_BASICO, $plan);

        $plan = new Plan();
        $plan->setName('Plan Intermedio');
        $plan->setDescription('Merienda incluida.');
        $plan->setDescription1('Seguimiento personalizado.');
        $plan->setDescription2('-');
        $plan->setAmount(1500);
        $plan->setShowPlan(true);
        $plan->setIsHighLighted(false);
        $manager->persist($plan);
        $this->addReference(self::PLAN_INTERMEDIO, $plan);

        $plan = new Plan();
        $plan->setName('Plan Premium');
        $plan->setDescription('Merienda incluida.');
        $plan->setDescription1('Seguimiento personalizado.');
        $plan->setDescription2('Acompañamiento docente permanente.');
        $plan->setAmount(2000);
        $plan->setShowPlan(true);
        $plan->setIsHighLighted(true);
        $manager->persist($plan);
        $this->addReference(self::PLAN_PREMIUM, $plan);

        $manager->flush();
    }
}
