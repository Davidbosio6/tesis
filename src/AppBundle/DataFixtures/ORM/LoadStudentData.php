<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Advisor;
use AppBundle\Entity\City;
use AppBundle\Entity\Classroom;
use AppBundle\Entity\MedicalHistory;
use AppBundle\Entity\Plan;
use AppBundle\Entity\Student;
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class LoadStudentData.
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class LoadStudentData extends AbstractFixture implements DependentFixtureInterface
{
    const STUDENT_51 = 'student_51';
    const STUDENT_52 = 'student_52';
    const STUDENT_53 = 'student_53';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        /** @var City $city1 */
        $city1 = $this->getReference(LoadCityData::CNEL_MOLDES);

        /** @var Advisor $advisor1 */
        $advisor1 = $this->getReference(LoadAdvisorData::ADVISOR_1);
        /** @var Advisor $advisor2 */
        $advisor2 = $this->getReference(LoadAdvisorData::ADVISOR_2);
        /** @var Advisor $advisor3 */
        $advisor3 = $this->getReference(LoadAdvisorData::ADVISOR_3);
        /** @var Advisor $advisor4 */
        $advisor4 = $this->getReference(LoadAdvisorData::ADVISOR_4);
        /** @var Advisor $advisor5 */
        $advisor5 = $this->getReference(LoadAdvisorData::ADVISOR_5);
        /** @var Advisor $advisor6 */
        $advisor6 = $this->getReference(LoadAdvisorData::ADVISOR_6);
        /** @var Advisor $advisor7 */
        $advisor7 = $this->getReference(LoadAdvisorData::ADVISOR_7);

        /** @var Classroom $classroom1 */
        $classroom1 = $this->getReference(LoadClassroomData::CELESTE);
        /** @var Classroom $classroom2 */
        $classroom2 = $this->getReference(LoadClassroomData::AMARILLA);
        /** @var Classroom $classroom3 */
        $classroom3 = $this->getReference(LoadClassroomData::ROJA);

        /** @var Classroom $classroom4 */
        $classroom4 = $this->getReference(LoadClassroomData::VERDE);
        /** @var Classroom $classroom5 */
        $classroom5 = $this->getReference(LoadClassroomData::VIOLETA);

        /** @var Plan $plan1 */
        $plan1 = $this->getReference(LoadPlanData::PLAN_BASICO);
        /** @var Plan $plan2 */
        $plan2 = $this->getReference(LoadPlanData::PLAN_INTERMEDIO);
        /** @var Plan $plan3 */
        $plan3 = $this->getReference(LoadPlanData::PLAN_PREMIUM);
        /** @var Plan $plan4 */
        $plan4 = $this->getReference(LoadPlanData::PLAN_BECA_50);
        /** @var Plan $plan5 */
        $plan5 = $this->getReference(LoadPlanData::PLAN_BECA_100);

        /** @var MedicalHistory $medicalHistory1 */
        $medicalHistory1 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_1);
        /** @var MedicalHistory $medicalHistory2 */
        $medicalHistory2 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_2);
        /** @var MedicalHistory $medicalHistory3 */
        $medicalHistory3 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_3);
        /** @var MedicalHistory $medicalHistory4 */
        $medicalHistory4 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_4);
        /** @var MedicalHistory $medicalHistory5 */
        $medicalHistory5 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_5);
        /** @var MedicalHistory $medicalHistory6 */
        $medicalHistory6 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_6);
        /** @var MedicalHistory $medicalHistory7 */
        $medicalHistory7 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_7);
        /** @var MedicalHistory $medicalHistory8 */
        $medicalHistory8 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_8);
        /** @var MedicalHistory $medicalHistory9 */
        $medicalHistory9 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_9);
        /** @var MedicalHistory $medicalHistory10 */
        $medicalHistory10 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_10);
        /** @var MedicalHistory $medicalHistory11 */
        $medicalHistory11 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_11);
        /** @var MedicalHistory $medicalHistory12 */
        $medicalHistory12 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_12);
        /** @var MedicalHistory $medicalHistory13 */
        $medicalHistory13 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_13);
        /** @var MedicalHistory $medicalHistory14 */
        $medicalHistory14 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_14);
        /** @var MedicalHistory $medicalHistory15 */
        $medicalHistory15 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_15);
        /** @var MedicalHistory $medicalHistory16 */
        $medicalHistory16 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_16);
        /** @var MedicalHistory $medicalHistory17 */
        $medicalHistory17 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_17);
        /** @var MedicalHistory $medicalHistory18 */
        $medicalHistory18 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_18);
        /** @var MedicalHistory $medicalHistory19 */
        $medicalHistory19 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_19);
        /** @var MedicalHistory $medicalHistory20 */
        $medicalHistory20 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_20);
        /** @var MedicalHistory $medicalHistory21 */
        $medicalHistory21 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_21);
        /** @var MedicalHistory $medicalHistory22 */
        $medicalHistory22 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_22);
        /** @var MedicalHistory $medicalHistory23 */
        $medicalHistory23 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_23);
        /** @var MedicalHistory $medicalHistory24 */
        $medicalHistory24 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_24);
        /** @var MedicalHistory $medicalHistory25 */
        $medicalHistory25 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_25);
        /** @var MedicalHistory $medicalHistory26 */
        $medicalHistory26 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_26);
        /** @var MedicalHistory $medicalHistory27 */
        $medicalHistory27 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_27);
        /** @var MedicalHistory $medicalHistory28 */
        $medicalHistory28 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_28);
        /** @var MedicalHistory $medicalHistory29 */
        $medicalHistory29 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_29);
        /** @var MedicalHistory $medicalHistory30 */
        $medicalHistory30 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_30);
        /** @var MedicalHistory $medicalHistory31 */
        $medicalHistory31 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_31);
        /** @var MedicalHistory $medicalHistory32 */
        $medicalHistory32 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_32);
        /** @var MedicalHistory $medicalHistory33 */
        $medicalHistory33 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_33);
        /** @var MedicalHistory $medicalHistory34 */
        $medicalHistory34 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_34);
        /** @var MedicalHistory $medicalHistory35 */
        $medicalHistory35 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_35);
        /** @var MedicalHistory $medicalHistory36 */
        $medicalHistory36 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_36);
        /** @var MedicalHistory $medicalHistory37 */
        $medicalHistory37 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_37);
        /** @var MedicalHistory $medicalHistory38 */
        $medicalHistory38 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_38);
        /** @var MedicalHistory $medicalHistory39 */
        $medicalHistory39 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_39);
        /** @var MedicalHistory $medicalHistory40 */
        $medicalHistory40 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_40);
        /** @var MedicalHistory $medicalHistory41 */
        $medicalHistory41 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_41);
        /** @var MedicalHistory $medicalHistory42 */
        $medicalHistory42 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_42);
        /** @var MedicalHistory $medicalHistory43 */
        $medicalHistory43 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_43);
        /** @var MedicalHistory $medicalHistory44 */
        $medicalHistory44 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_44);
        /** @var MedicalHistory $medicalHistory45 */
        $medicalHistory45 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_45);
        /** @var MedicalHistory $medicalHistory46 */
        $medicalHistory46 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_46);
        /** @var MedicalHistory $medicalHistory47 */
        $medicalHistory47 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_47);
        /** @var MedicalHistory $medicalHistory48 */
        $medicalHistory48 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_48);
        /** @var MedicalHistory $medicalHistory49 */
        $medicalHistory49 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_49);
        /** @var MedicalHistory $medicalHistory50 */
        $medicalHistory50 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_50);
        /** @var MedicalHistory $medicalHistory51 */
        $medicalHistory51 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_51);
        /** @var MedicalHistory $medicalHistory52 */
        $medicalHistory52 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_52);
        /** @var MedicalHistory $medicalHistory53 */
        $medicalHistory53 = $this->getReference(LoadMedicalHistoryData::MEDICAL_HISTORY_53);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 65));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80637212);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Mariano Moerno 120');
        $student->setFirstName('Lucia');
        $student->setLastName('Cabral');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory53);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 64));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80601202);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('La Rioja 32');
        $student->setFirstName('Valentin');
        $student->setLastName('Pereyra');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory52);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 64));
        $student->setCodeId($hashedId);
        $student->setIdNumber(81019103);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Martin Queno 614 32');
        $student->setFirstName('Martina');
        $student->setLastName('Oviedo');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory51);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 63));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80769202);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('La Rioja 32');
        $student->setFirstName('Josefina');
        $student->setLastName('Gimenez');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory50);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 62));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82764092);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('San Juan 123');
        $student->setFirstName('Leandro');
        $student->setLastName('Gomez');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory49);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 61));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83209872);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Caseros 90');
        $student->setFirstName('Lucia');
        $student->setLastName('Moiso');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory48);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 60));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83209182);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Obispo Trejo 1402');
        $student->setFirstName('Lisa');
        $student->setLastName('Funes');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory47);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 59));
        $student->setCodeId($hashedId);
        $student->setIdNumber(84028938);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Mendoza 3203');
        $student->setFirstName('Andres');
        $student->setLastName('Arneodo');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory46);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 58));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82093920);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('San Juan 620');
        $student->setFirstName('Facundo');
        $student->setLastName('Viale');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory45);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 57));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83409291);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Belgrano 90');
        $student->setFirstName('Dana');
        $student->setLastName('Paola');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory44);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 56));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80698399);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('La Rioja 290');
        $student->setFirstName('Samanta');
        $student->setLastName('Garcia');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory43);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 55));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83009839);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Formosa 2390');
        $student->setFirstName('Rosa');
        $student->setLastName('Linardi');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory42);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 54));
        $student->setCodeId($hashedId);
        $student->setIdNumber(81003927);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Dean Funes 2103');
        $student->setFirstName('Lola');
        $student->setLastName('Garcia');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory41);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 53));
        $student->setCodeId($hashedId);
        $student->setIdNumber(90009303);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('9 de Julio 1158');
        $student->setFirstName('Sandro');
        $student->setLastName('Leon');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom5);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory40);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 52));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82098917);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Paraguay 1030');
        $student->setFirstName('Manuel');
        $student->setLastName('Castillo');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory39);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 51));
        $student->setCodeId($hashedId);
        $student->setIdNumber(81093917);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Lima 230');
        $student->setFirstName('Alejandra');
        $student->setLastName('Zatti');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory38);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 50));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80991917);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Peru 391');
        $student->setFirstName('Lucrecia');
        $student->setLastName('Simonetto');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory37);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 49));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83099383);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Santa Cruz 2310');
        $student->setFirstName('Agos');
        $student->setLastName('Muñoz');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory36);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 48));
        $student->setCodeId($hashedId);
        $student->setIdNumber(84201992);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Sarmiento 240');
        $student->setFirstName('Amparo');
        $student->setLastName('Muñoz');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory35);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 47));
        $student->setCodeId($hashedId);
        $student->setIdNumber(85000299);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Independencia 290');
        $student->setFirstName('Franco');
        $student->setLastName('Fesia');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory34);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 46));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83000920);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Velez Sarfield 3310');
        $student->setFirstName('Gabriel');
        $student->setLastName('Ciciaro');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom5);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory33);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 45));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82299807);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Mexico 3931');
        $student->setFirstName('Tamara');
        $student->setLastName('Diaz');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom5);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory32);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 44));
        $student->setCodeId($hashedId);
        $student->setIdNumber(81210087);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Habanna 332');
        $student->setFirstName('Rosario');
        $student->setLastName('Medici');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory31);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 43));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82559020);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('General Artigas 290');
        $student->setFirstName('Eliana');
        $student->setLastName('Perez');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory30);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 42));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80320956);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Derqui 1928');
        $student->setFirstName('Luciano');
        $student->setLastName('Mansilla');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory29);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 41));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82999289);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Calasansz 120');
        $student->setFirstName('Antonela');
        $student->setLastName('Rizzo');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory28);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 40));
        $student->setCodeId($hashedId);
        $student->setIdNumber(84000291);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Chubut 1560');
        $student->setFirstName('Facundo');
        $student->setLastName('Galera');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory27);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 39));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82998773);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Chaco 670');
        $student->setFirstName('Florencia');
        $student->setLastName('Aguilar');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory26);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 38));
        $student->setCodeId($hashedId);
        $student->setIdNumber(79991882);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Jose Verdi 45');
        $student->setFirstName('Juan Pablo');
        $student->setLastName('Rosetti');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory25);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 37));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82000902);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Francisco Soler 1023');
        $student->setFirstName('Nicolas');
        $student->setLastName('Sola');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory24);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 36));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82212757);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Palestina 89');
        $student->setFirstName('Juan');
        $student->setLastName('Garcia');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory23);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 35));
        $student->setCodeId($hashedId);
        $student->setIdNumber(84567839);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Santa Ana 290');
        $student->setFirstName('Fiama');
        $student->setLastName('Garais');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory22);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 34));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80112917);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Independencia 290');
        $student->setFirstName('Carmela');
        $student->setLastName('Gutierrez');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory21);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 33));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82569382);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Santa Rosa 1398');
        $student->setFirstName('Cristian');
        $student->setLastName('Airaudo');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory20);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 32));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82901029);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('27 de abril 290');
        $student->setFirstName('Santiago');
        $student->setLastName('del Valle');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory19);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 31));
        $student->setCodeId($hashedId);
        $student->setIdNumber(81093903);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Boulevard Illia 290');
        $student->setFirstName('Facundo');
        $student->setLastName('Gatti');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory18);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 30));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83457821);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Velez Sarfield 290');
        $student->setFirstName('Irupe');
        $student->setLastName('Alvarado');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory17);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 29));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82392019);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('General Paz 290');
        $student->setFirstName('Analia');
        $student->setLastName('Diaz');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom5);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory16);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 28));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82098730);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Paso de los Andes 320');
        $student->setFirstName('Oliver');
        $student->setLastName('Cardetti');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom5);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory15);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 27));
        $student->setCodeId($hashedId);
        $student->setIdNumber(81590907);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('9 de Julio 23');
        $student->setFirstName('Paulina');
        $student->setLastName('Valdes');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory14);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 26));
        $student->setCodeId($hashedId);
        $student->setIdNumber(84233908);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Sarmiento 490');
        $student->setFirstName('Juana');
        $student->setLastName('Juarez');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory13);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 25));
        $student->setCodeId($hashedId);
        $student->setIdNumber(82424907);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Cincuentenario 304');
        $student->setFirstName('Melany');
        $student->setLastName('Martinez');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory12);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 24));
        $student->setCodeId($hashedId);
        $student->setIdNumber(81222907);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Agustin Tosco 65');
        $student->setFirstName('Gina');
        $student->setLastName('Giovanella');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory11);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 23));
        $student->setCodeId($hashedId);
        $student->setIdNumber(79834053);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Piacenza 400');
        $student->setFirstName('Pablo');
        $student->setLastName('Agustin');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom1);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory10);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 22));
        $student->setCodeId($hashedId);
        $student->setIdNumber(80217987);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Mariano Moreno 1389');
        $student->setFirstName('Lara');
        $student->setLastName('Godoy');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom3);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory9);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 21));
        $student->setCodeId($hashedId);
        $student->setIdNumber(79879001);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Rivadavia 29');
        $student->setFirstName('Mateo');
        $student->setLastName('Larrea');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom2);
        $student->setPlan($plan4);
        $student->setMedicalHistory($medicalHistory8);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 20));
        $student->setCodeId($hashedId);
        $student->setIdNumber(83472987);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Colon 25');
        $student->setFirstName('Dalila');
        $student->setLastName('Montenegro');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory7);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 19));
        $student->setCodeId($hashedId);
        $student->setIdNumber(86348293);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Maipú 1209');
        $student->setFirstName('Juan');
        $student->setLastName('Casas');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->setClassroom($classroom4);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory6);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 5));
        $student->setCodeId($hashedId);
        $student->setIdNumber(90568100);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('Presidente Roca 210');
        $student->setFirstName('Mariano');
        $student->setLastName('Lopez');
        $student->setSex('Masculino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->addAdvisor($advisor7);
        $student->setClassroom($classroom1);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory5);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 4));
        $student->setCodeId($hashedId);
        $student->setIdNumber(90208989);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('Colon 90');
        $student->setFirstName('Micaela');
        $student->setLastName('Sosa');
        $student->setSex('Femenino');
        $student->setPhoto('empty.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->addAdvisor($advisor6);
        $student->setClassroom($classroom2);
        $student->setPlan($plan2);
        $student->setMedicalHistory($medicalHistory4);
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 3));
        $student->setCodeId($hashedId);
        $student->setIdNumber(79211909);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('Colon 230');
        $student->setFirstName('Juan');
        $student->setLastName('Pereyra');
        $student->setSex('Masculino');
        $student->setPhoto('student_51.png');
        $student->setInstallmentsGenerated(true);
        $student->setCity($city1);
        $student->addAdvisor($advisor5);
        $student->setClassroom($classroom3);
        $student->setPlan($plan3);
        $student->setMedicalHistory($medicalHistory3);
        $manager->persist($student);
        $this->addReference(self::STUDENT_51, $student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 1));
        $student->setCodeId($hashedId);
        $student->setIdNumber(86201589);
        $student->setBirthdate(new DateTime('now -3 years'));
        $student->setAddress('Mendoza 32');
        $student->setFirstName('Francisca');
        $student->setLastName('Gil');
        $student->setSex('Femenino');
        $student->setPhoto('student_1.png');
        $student->setInstallmentsGenerated(false);
        $student->setCity($city1);
        $student->addAdvisor($advisor1);
        $student->addAdvisor($advisor2);
        $student->setClassroom($classroom4);
        $student->setPlan($plan5);
        $student->setMedicalHistory($medicalHistory1);
        $manager->persist($student);
        $this->addReference(self::STUDENT_52, $student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 2));
        $student->setCodeId($hashedId);
        $student->setIdNumber(85106439);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $student->setAddress('Maipú 1209');
        $student->setFirstName('Ramiro');
        $student->setLastName('Fernandez');
        $student->setSex('Masculino');
        $student->setPhoto('student_2.png');
        $student->setInstallmentsGenerated(true);
        $student->setCity($city1);
        $student->addAdvisor($advisor3);
        $student->addAdvisor($advisor4);
        $student->setClassroom($classroom5);
        $student->setPlan($plan1);
        $student->setMedicalHistory($medicalHistory2);
        $manager->persist($student);
        $this->addReference(self::STUDENT_53, $student);

        //------------------------------------------------ PRE-SING-UP STUDENTS

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 6));
        $student->setCodeId($hashedId);
        $student->setFirstName('Camilo');
        $student->setLastName('Juarez');
        $student->setSex('Masculino');
        $student->setIdNumber(86703290);
        $student->setAddress('Bolivia 120');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 7));
        $student->setCodeId($hashedId);
        $student->setFirstName('Juliana');
        $student->setLastName('Contreras');
        $student->setSex('Femenino');
        $student->setIdNumber(79988320);
        $student->setAddress('Caseros 613');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 8));
        $student->setCodeId($hashedId);
        $student->setFirstName('Cinthia');
        $student->setLastName('Ponce');
        $student->setSex('Femenino');
        $student->setIdNumber(88293043);
        $student->setAddress('9 de Julio 38');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 9));
        $student->setCodeId($hashedId);
        $student->setFirstName('Matias');
        $student->setLastName('Fernandez');
        $student->setSex('Masculino');
        $student->setIdNumber(82789442);
        $student->setAddress('9 de Julio 1220');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 10));
        $student->setCodeId($hashedId);
        $student->setFirstName('Javier');
        $student->setLastName('Cortez');
        $student->setSex('Masculino');
        $student->setIdNumber(84789345);
        $student->setAddress('Rivadavia 10');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 11));
        $student->setCodeId($hashedId);
        $student->setFirstName('Jimena');
        $student->setLastName('Pizarro');
        $student->setSex('Femenino');
        $student->setIdNumber(91456783);
        $student->setAddress('Figueroa Alcorta 1103');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 12));
        $student->setCodeId($hashedId);
        $student->setFirstName('Sebastian');
        $student->setLastName('Turletti');
        $student->setSex('Masculino');
        $student->setIdNumber(89203490);
        $student->setAddress('Mitre 103');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 13));
        $student->setCodeId($hashedId);
        $student->setFirstName('Sofia');
        $student->setLastName('Real');
        $student->setSex('Femenino');
        $student->setIdNumber(88289315);
        $student->setAddress('Cabildo 1409');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 14));
        $student->setCodeId($hashedId);
        $student->setFirstName('Lucas');
        $student->setLastName('Contreras');
        $student->setSex('Masculino');
        $student->setIdNumber(86103297);
        $student->setAddress('Guemes 103');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 15));
        $student->setCodeId($hashedId);
        $student->setFirstName('Federico');
        $student->setLastName('Funes');
        $student->setSex('Masculino');
        $student->setIdNumber(85204208);
        $student->setAddress('Guemes 103');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 16));
        $student->setCodeId($hashedId);
        $student->setFirstName('Lucia');
        $student->setLastName('Sosa');
        $student->setSex('Femenino');
        $student->setIdNumber(85335209);
        $student->setAddress('Mitre 983');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 17));
        $student->setCodeId($hashedId);
        $student->setFirstName('Manuela');
        $student->setLastName('Gomez');
        $student->setSex('Femenino');
        $student->setIdNumber(87125307);
        $student->setAddress('Mariano Moreno 983');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $student = new Student();
        $hashedId = strtoupper(hash('crc32', 18));
        $student->setCodeId($hashedId);
        $student->setFirstName('Denisse');
        $student->setLastName('Garcia');
        $student->setSex('Femenino');
        $student->setIdNumber(88567318);
        $student->setAddress('Castro Barros 209');
        $student->setCity($city1);
        $student->setBirthdate(new DateTime('+1 month -3 years'));
        $manager->persist($student);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            LoadCityData::class,
            LoadAdvisorData::class,
            LoadClassroomData::class,
            LoadPlanData::class,
            LoadMedicalHistoryData::class
        ];
    }
}
