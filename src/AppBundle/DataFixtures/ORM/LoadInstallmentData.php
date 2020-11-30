<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Installment;
use AppBundle\Entity\Student;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LoadInstallmentData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Student $student1 */
        $student1 = $this->getReference(LoadStudentData::STUDENT_1);
        /** @var Student $student2 */
        $student2 = $this->getReference(LoadStudentData::STUDENT_2);

        $installment = new Installment();
        $installment->setStudent($student1)
            ->setAmount($student1->getPlan()->getAmount())
            ->setState(Installment::PAID_STATE)
            ->setDescription('Cuota Octubre')
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/a5b2b864-31c6-11eb-a2e5-160dac5dea65')
            ->setDueDate($this->generateDueDate(10));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student1)
            ->setAmount($student1->getPlan()->getAmount())
            ->setState(Installment::PAID_STATE)
            ->setDescription('Cuota Noviembre')
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/a5b2b864-31c6-11eb-a2e5-160dac5dea65')
            ->setDueDate($this->generateDueDate(11));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student1)
            ->setAmount($student1->getPlan()->getAmount())
            ->setState(Installment::PENDING_STATE)
            ->setDescription('Cuota Diciembre')
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/a3af7358-31d6-11eb-a4a3-160dac5dea65')
            ->setDueDate($this->generateDueDate(12));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student2)
            ->setAmount($student2->getPlan()->getAmount())
            ->setState(Installment::PAID_STATE)
            ->setDescription('Cuota Octubre')
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/a5b2b864-31c6-11eb-a2e5-160dac5dea65')
            ->setDueDate($this->generateDueDate(10));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student2)
            ->setAmount($student2->getPlan()->getAmount())
            ->setState(Installment::PAID_STATE)
            ->setDescription('Cuota Noviembre')
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/a5b2b864-31c6-11eb-a2e5-160dac5dea65')
            ->setDueDate($this->generateDueDate(11));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student2)
            ->setAmount($student2->getPlan()->getAmount())
            ->setState(Installment::PENDING_STATE)
            ->setDescription('Cuota Diciembre')
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/a40593b4-31d6-11eb-b77c-160dac5dea65')
            ->setDueDate($this->generateDueDate(12));
        $manager->persist($installment);

        $manager->flush();
    }

    /**
     * @param string $month
     *
     * @return DateTime
     */
    public function generateDueDate(
        string $month
    ): DateTime {
        return date_create(sprintf(
            '%s-%s-%s',
            2020,
            $month,
            15,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            LoadStudentData::class,
        ];
    }
}
