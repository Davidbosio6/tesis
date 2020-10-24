<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Student.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Student
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $idNumber;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="string")
     */
    private $sex;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City", inversedBy="students")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @var Classroom
     *
     * @ORM\ManyToOne(targetEntity="Classroom", inversedBy="students")
     * @ORM\JoinColumn(name="classroom_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $classroom;

    /**
     * @var Advisor
     *
     * @ORM\OneToMany(targetEntity="Advisor", mappedBy="student", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="advisor_id", referencedColumnName="id", nullable=true)
     *
     * @Assert\Count(min=1)
     */
    private $advisors;

    /**
     * @var Plan
     *
     * @ORM\ManyToOne(targetEntity="Plan", inversedBy="students")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $plan;

    /**
     * @var MedicalHistory
     *
     * @ORM\OneToOne(targetEntity="MedicalHistory", inversedBy="student", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="medical_history_id", referencedColumnName="id", nullable=true)
     */
    private $medicalHistory;

    public function __construct()
    {
        $this->advisors = new ArrayCollection();
    }

    /**
     * Gets triggered every time on persist.
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * Gets triggered every time on update.
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(
        DateTime $updatedAt
    ): self {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string $idNumber
     *
     * @return self
     */
    public function setIdNumber(
        string $idNumber
    ): self {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return self
     */
    public function setFirstName(
        string $firstName
    ): self {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return self
     */
    public function setLastName(
        string $lastName
    ): self {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @param City $city
     *
     * @return self
     */
    public function setCity(
        City $city
    ): self {
        $this->city = $city;

        return $this;
    }

    /**
     * @return City
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @param string $address
     *
     * @return self
     */
    public function setAddress(
        string $address
    ): self {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param DateTime $birthdate
     *
     * @return self
     */
    public function setBirthdate(
        DateTime $birthdate
    ): self {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getBirthdate(): ?DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param string|null $notes
     *
     * @return self
     */
    public function setNotes(
        string $notes = null
    ): self {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param Classroom $classroom
     *
     * @return self
     */
    public function setClassroom(
        Classroom $classroom
    ): self {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return Classroom
     */
    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    /**
     * @param Advisor $advisor
     *
     * @return self
     */
    public function addAdvisor(Advisor $advisor): self
    {
        $this->advisors[] = $advisor;
        $advisor->setStudent($this);

        return $this;
    }

    /**
     * @param Advisor $advisor
     */
    public function removeAdvisor(Advisor $advisor)
    {
        $this->advisors->removeElement($advisor);
        $advisor->setStudent(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getAdvisors()
    {
        return $this->advisors;
    }

    /**
     * @param Plan $plan
     *
     * @return self
     */
    public function setPlan(
        Plan $plan
    ): self {
        $this->plan = $plan;

        return $this;
    }

    /**
     * @return Plan
     */
    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    /**
     * @param string|null $sex
     *
     * @return self
     */
    public function setSex(
        string $sex = null
    ): self {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @return string
     */
    public function getSex(): ?string
    {
        return $this->sex;
    }

    /**
     * @param MedicalHistory $medicalHistory
     *
     * @return self
     */
    public function setMedicalHistory (
        MedicalHistory $medicalHistory
    ): self {
        $this->medicalHistory = $medicalHistory;

        return $this;
    }

    /**
     * @return MedicalHistory
     */
    public function getMedicalHistory (): ?MedicalHistory
    {
        return $this->medicalHistory;
    }
}
