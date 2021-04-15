<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Installment;
use AppBundle\Entity\Student;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadInstallmentData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadInstallmentData extends AbstractFixture implements FixtureInterface, DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var Student $student51 */
        $student51 = $this->getReference(LoadStudentData::STUDENT_51);
        /** @var Student $student53 */
        $student53 = $this->getReference(LoadStudentData::STUDENT_53);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PAID_STATE)
            ->setMonth(2)
            ->setDescription('Cuota Febrero')
            ->setTransactionId(986489)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/83c03616-6383-11eb-90d2-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/83c03616-6383-11eb-90d2-160dac5dea65')
            ->setDueDate($this->generateDueDate(2));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PAID_STATE)
            ->setMonth(3)
            ->setDescription('Cuota Marzo')
            ->setTransactionId(986490)
            ->setCheckoutUrl('https://sandboxapi.pagos360.com/payment-request/pdf/8413394c-6383-11eb-b104-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/8413394c-6383-11eb-b104-160dac5dea65')
            ->setDueDate($this->generateDueDate(3));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PAID_STATE)
            ->setMonth(4)
            ->setDescription('Cuota Abril')
            ->setTransactionId(986491)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/845e4400-6383-11eb-80e5-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/845e4400-6383-11eb-80e5-160dac5dea65')
            ->setDueDate($this->generateDueDate(4));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(5)
            ->setDescription('Cuota Mayo')
            ->setTransactionId(986492)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/84a29466-6383-11eb-8199-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/84a29466-6383-11eb-8199-160dac5dea65')
            ->setDueDate($this->generateDueDate(5));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(6)
            ->setDescription('Cuota Junio')
            ->setTransactionId(986493)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/851a8098-6383-11eb-9762-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/851a8098-6383-11eb-9762-160dac5dea65')
            ->setDueDate($this->generateDueDate(6));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(7)
            ->setDescription('Cuota Julio')
            ->setTransactionId(986494)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/8567123c-6383-11eb-9d16-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/8567123c-6383-11eb-9d16-160dac5dea65')
            ->setDueDate($this->generateDueDate(7));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(8)
            ->setDescription('Cuota Agosto')
            ->setTransactionId(986495)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/85a7bdfa-6383-11eb-8cd9-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/85a7bdfa-6383-11eb-8cd9-160dac5dea65')
            ->setDueDate($this->generateDueDate(8));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(9)
            ->setDescription('Cuota Septiembre')
            ->setTransactionId(986496)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/85ec89d0-6383-11eb-96dd-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/85ec89d0-6383-11eb-96dd-160dac5dea65')
            ->setDueDate($this->generateDueDate(9));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(10)
            ->setDescription('Cuota Octubre')
            ->setTransactionId(986497)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/863585fe-6383-11eb-aeed-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/863585fe-6383-11eb-aeed-160dac5dea65')
            ->setDueDate($this->generateDueDate(10));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(11)
            ->setDescription('Cuota Noviembre')
            ->setTransactionId(986498)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/867d5e4c-6383-11eb-a8f1-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/867d5e4c-6383-11eb-a8f1-160dac5dea65')
            ->setDueDate($this->generateDueDate(11));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student51)
            ->setAmount(2000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(12)
            ->setDescription('Cuota Diciembre')
            ->setTransactionId(986499)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/86be17de-6383-11eb-8a3d-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/86be17de-6383-11eb-8a3d-160dac5dea65')
            ->setDueDate($this->generateDueDate(12));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PAID_STATE)
            ->setMonth(2)
            ->setDescription('Cuota Febrero')
            ->setTransactionId(986467)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/a9bc2768-6373-11eb-bfa9-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/a9bc2768-6373-11eb-bfa9-160dac5dea65')
            ->setDueDate($this->generateDueDate(2));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::EXPIRED_STATE)
            ->setMonth(3)
            ->setDescription('Cuota Marzo')
            ->setTransactionId(986468)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/aa075e36-6373-11eb-8f68-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/aa075e36-6373-11eb-8f68-160dac5dea65')
            ->setDueDate($this->generateDueDate(3));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PAID_STATE)
            ->setMonth(4)
            ->setDescription('Cuota Abril')
            ->setTransactionId(986469)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/aa4fb62c-6373-11eb-9c8f-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/aa4fb62c-6373-11eb-9c8f-160dac5dea65')
            ->setDueDate($this->generateDueDate(4));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(5)
            ->setDescription('Cuota Mayo')
            ->setTransactionId(986470)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/aa941880-6373-11eb-959d-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/aa941880-6373-11eb-959d-160dac5dea65')
            ->setDueDate($this->generateDueDate(5));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(6)
            ->setDescription('Cuota Junio')
            ->setTransactionId(986471)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/aad7c97c-6373-11eb-a5e6-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/aad7c97c-6373-11eb-a5e6-160dac5dea65')
            ->setDueDate($this->generateDueDate(6));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(7)
            ->setDescription('Cuota Julio')
            ->setTransactionId(986472)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/ab32f8b0-6373-11eb-8acf-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/ab32f8b0-6373-11eb-8acf-160dac5dea65')
            ->setDueDate($this->generateDueDate(7));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(8)
            ->setDescription('Cuota Agosto')
            ->setTransactionId(986473)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/aba058e2-6373-11eb-a66d-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/aba058e2-6373-11eb-a66d-160dac5dea65')
            ->setDueDate($this->generateDueDate(8));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(9)
            ->setDescription('Cuota Septiembre')
            ->setTransactionId(986474)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/abf0406e-6373-11eb-999b-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/abf0406e-6373-11eb-999b-160dac5dea65')
            ->setDueDate($this->generateDueDate(9));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(10)
            ->setDescription('Cuota Octubre')
            ->setTransactionId(986475)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/ac337e6a-6373-11eb-b2ef-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/ac337e6a-6373-11eb-b2ef-160dac5dea65')
            ->setDueDate($this->generateDueDate(10));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(11)
            ->setDescription('Cuota Noviembre')
            ->setTransactionId(986476)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/ac7a5a06-6373-11eb-aa7e-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/ac7a5a06-6373-11eb-aa7e-160dac5dea65')
            ->setDueDate($this->generateDueDate(11));
        $manager->persist($installment);

        $installment = new Installment();
        $installment->setStudent($student53)
            ->setAmount(1000)
            ->setState(Installment::PENDING_STATE)
            ->setMonth(12)
            ->setDescription('Cuota Diciembre')
            ->setTransactionId(986477)
            ->setCheckoutUrl('https://sandboxcheckout.pagos360.com/payment-request/acea3664-6373-11eb-a824-160dac5dea65')
            ->setPdfUrl('https://sandboxapi.pagos360.com/payment-request/pdf/acea3664-6373-11eb-a824-160dac5dea65')
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
            2021,
            $month,
            15
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadStudentData::class,
        ];
    }
}
