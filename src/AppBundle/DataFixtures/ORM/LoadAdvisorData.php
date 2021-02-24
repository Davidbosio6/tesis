<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Advisor;
use AppBundle\Entity\City;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadAdvisorData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadAdvisorData extends AbstractFixture implements DependentFixtureInterface
{
    const ADVISOR_1 = 'a_advisor_1';

    const ADVISOR_2 = 'a_advisor_2';

    const ADVISOR_3 = 'a_advisor_3';

    const ADVISOR_4 = 'a_advisor_4';

    const ADVISOR_5 = 'a_advisor_5';

    const ADVISOR_6 = 'a_advisor_6';

    const ADVISOR_7 = 'a_advisor_7';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var City $city1 */
        $city1 = $this->getReference(LoadCityData::RIO_CUARTO);
        /** @var City $city2 */
        $city2 = $this->getReference(LoadCityData::CNEL_MOLDES);

        $advisor = new Advisor();
        $advisor->setIdNumber(29304987);
        $advisor->setEmail('mvilla@noemail.com');
        $advisor->setBirthdate(new DateTime('+1 week -2 months -25 years'));
        $advisor->setStudentRelationship('Madre');
        $advisor->setAddress('Mendoza 32');
        $advisor->setPhoneNumber('3582402903');
        $advisor->setFirstName('Malena');
        $advisor->setLastName('Villa');
        $advisor->setPhoto('advisor_1.png');
        $advisor->setCity($city1);
        $manager->persist($advisor);
        $this->addReference(self::ADVISOR_1, $advisor);

        $advisor = new Advisor();
        $advisor->setIdNumber(25990234);
        $advisor->setEmail('jingaramo@noemail.com');
        $advisor->setBirthdate(new DateTime('+13 weeks -2 months -31 years'));
        $advisor->setStudentRelationship('Padre');
        $advisor->setAddress('Mendoza 32');
        $advisor->setPhoneNumber('3582039401');
        $advisor->setFirstName('Juan');
        $advisor->setLastName('Ingaramo');
        $advisor->setPhoto('advisor_2.png');
        $advisor->setCity($city2);
        $manager->persist($advisor);
        $this->addReference(self::ADVISOR_2, $advisor);

        $advisor = new Advisor();
        $advisor->setIdNumber(21003928);
        $advisor->setEmail('scelli@noemail.com');
        $advisor->setBirthdate(new DateTime('now -2 months -20 years'));
        $advisor->setStudentRelationship('Padre');
        $advisor->setAddress('Maipú 1209');
        $advisor->setPhoneNumber('3582402910');
        $advisor->setFirstName('Santiago');
        $advisor->setLastName('Celli');
        $advisor->setPhoto('advisor_3.png');
        $advisor->setCity($city2);
        $manager->persist($advisor);
        $this->addReference(self::ADVISOR_3, $advisor);

        $advisor = new Advisor();
        $advisor->setIdNumber(26390002);
        $advisor->setEmail('fcollina@noemail.com');
        $advisor->setBirthdate(new DateTime('+3 months -20 years'));
        $advisor->setStudentRelationship('Madre');
        $advisor->setAddress('Maipú 1209');
        $advisor->setPhoneNumber('3582402910');
        $advisor->setFirstName('Feli');
        $advisor->setLastName('Colina');
        $advisor->setPhoto('advisor_4.png');
        $advisor->setCity($city2);
        $manager->persist($advisor);
        $this->addReference(self::ADVISOR_4, $advisor);

        $advisor = new Advisor();
        $advisor->setIdNumber(22204001);
        $advisor->setEmail('ssilva@noemail.com');
        $advisor->setBirthdate(new DateTime('+1 week -2 months -30 years'));
        $advisor->setStudentRelationship('Padre');
        $advisor->setAddress('Catamarca 132');
        $advisor->setPhoneNumber('3582342278');
        $advisor->setFirstName('Santiago');
        $advisor->setLastName('Silva');
        $advisor->setPhoto('advisor_5.png');
        $advisor->setCity($city1);
        $manager->persist($advisor);
        $this->addReference(self::ADVISOR_5, $advisor);

        $advisor = new Advisor();
        $advisor->setIdNumber(23402890);
        $advisor->setEmail('ccabello@noemail.com');
        $advisor->setBirthdate(new DateTime('+2 week -4 months -45 years'));
        $advisor->setStudentRelationship('Madre');
        $advisor->setAddress('Mariano Moreno 29');
        $advisor->setPhoneNumber('3581592978');
        $advisor->setFirstName('Carolina');
        $advisor->setLastName('Castro');
        $advisor->setPhoto('empty.png');
        $advisor->setCity($city1);
        $manager->persist($advisor);
        $this->addReference(self::ADVISOR_6, $advisor);

        $advisor = new Advisor();
        $advisor->setIdNumber(21493200);
        $advisor->setEmail('jmanso@noemail.com');
        $advisor->setBirthdate(new DateTime('+2 week -4 months -45 years'));
        $advisor->setStudentRelationship('Padre');
        $advisor->setAddress('Colon 1220');
        $advisor->setPhoneNumber('3581592978');
        $advisor->setFirstName('Javier');
        $advisor->setLastName('Manso');
        $advisor->setPhoto('empty.png');
        $advisor->setCity($city1);
        $manager->persist($advisor);
        $this->addReference(self::ADVISOR_7, $advisor);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadCityData::class,
        ];
    }
}
