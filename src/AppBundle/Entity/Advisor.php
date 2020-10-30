<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Advisor.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="advisor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvisorRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Advisor
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
     * @ORM\Column(type="string", length=254)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $studentRelationship;

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
     * @ORM\Column(type="string", length=13)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City", inversedBy="advisors")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="advisors")
     */
    private $student;

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
     * @param string $email
     *
     * @return self
     */
    public function setEmail(
        string $email
    ): self {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
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
     * @param string $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(
        string $phoneNumber
    ): self {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
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
     * @param Student $student
     *
     * @return self
     */
    public function setStudent (
        Student $student
    ): self {
        $this->student = $student;

        return $this;
    }

    /**
     * @return Student
     */
    public function getStudent (): ?Student
    {
        return $this->student;
    }

    /**
     * @return string
     */
    public function getStudentRelationship(): ?string
    {
        return $this->studentRelationship;
    }

    /**
     * @param string $studentRelationship
     *
     * @return self
     */
    public function setStudentRelationship(
        string $studentRelationship
    ): self {
        $this->studentRelationship = $studentRelationship;

        return $this;
    }

    /**
     * @param string|null $photo
     *
     * @return self
     */
    public function setPhoto(
        string $photo = null
    ): self {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }
}
