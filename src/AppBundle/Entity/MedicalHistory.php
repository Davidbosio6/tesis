<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class MedicalHistory.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="medical_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MedicalHistoryRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class MedicalHistory
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
     * @ORM\Column(type="string")
     */
    private $weight;

    /**
     * @ORM\Column(type="string")
     */
    private $height;

    /**
     * @ORM\Column(type="string")
     */
    private $bloodType;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $allergy;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $chronicIllness;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $medicine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $asma;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sinusitis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $bronquitis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $otitis;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tosConvulsiva;

    /**
     * @ORM\Column(type="boolean")
     */
    private $migrania;

    /**
     * @ORM\Column(type="boolean")
     */
    private $diabetes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $celiaco;

    /**
     * @var Student
     *
     * @ORM\OneToOne(targetEntity="Student", mappedBy="medicalHistory")
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
     * @param string $weight
     *
     * @return self
     */
    public function setWeight(
        string $weight
    ): self {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param string $height
     *
     * @return self
     */
    public function setHeight(
        string $height
    ): self {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeight(): ?string
    {
        return $this->height;
    }

    /**
     * @param string $bloodType
     *
     * @return self
     */
    public function setBloodType(
        string $bloodType
    ): self {
        $this->bloodType = $bloodType;

        return $this;
    }

    /**
     * @return string
     */
    public function getBloodType(): ?string
    {
        return $this->bloodType;
    }

    /**
     * @param string|null $allergy
     *
     * @return self
     */
    public function setAllergy(
        string $allergy = null
    ): self {
        $this->allergy = $allergy;

        return $this;
    }

    /**
     * @return string
     */
    public function getAllergy(): ?string
    {
        return $this->allergy;
    }

    /**
     * @param string|null $chronicIllness
     *
     * @return self
     */
    public function setChronicIllness(
        string $chronicIllness = null
    ): self {
        $this->chronicIllness = $chronicIllness;

        return $this;
    }

    /**
     * @return string
     */
    public function getChronicIllness(): ?string
    {
        return $this->chronicIllness;
    }

    /**
     * @param string|null $medicine
     *
     * @return self
     */
    public function setMedicine(
        string $medicine = null
    ): self {
        $this->medicine = $medicine;

        return $this;
    }

    /**
     * @return string
     */
    public function getMedicine(): ?string
    {
        return $this->medicine;
    }

    /**
     * @param bool $asma
     *
     * @return self
     */
    public function setAsma(
        bool $asma
    ): self {
        $this->asma = $asma;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAsma(): ?bool
    {
        return $this->asma;
    }

    /**
     * @param bool $sinusitis
     *
     * @return self
     */
    public function setSinusitis(
        bool $sinusitis
    ): self {
        $this->sinusitis = $sinusitis;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSinusitis(): ?bool
    {
        return $this->sinusitis;
    }

    /**
     * @param bool $bronquitis
     *
     * @return self
     */
    public function setBronquitis(
        bool $bronquitis
    ): self {
        $this->bronquitis = $bronquitis;

        return $this;
    }

    /**
     * @return bool
     */
    public function getBronquitis(): ?bool
    {
        return $this->bronquitis;
    }

    /**
     * @param bool $otitis
     *
     * @return self
     */
    public function setOtitis(
        bool $otitis
    ): self {
        $this->otitis = $otitis;

        return $this;
    }

    /**
     * @return bool
     */
    public function getOtitis(): ?bool
    {
        return $this->otitis;
    }

    /**
     * @param bool $tosConvulsiva
     *
     * @return self
     */
    public function setTosConvulsiva(
        bool $tosConvulsiva
    ): self {
        $this->tosConvulsiva = $tosConvulsiva;

        return $this;
    }

    /**
     * @return bool
     */
    public function getTosConvulsiva(): ?bool
    {
        return $this->tosConvulsiva;
    }

    /**
     * @param bool $migrania
     *
     * @return self
     */
    public function setMigrania(
        bool $migrania
    ): self {
        $this->migrania = $migrania;

        return $this;
    }

    /**
     * @return bool
     */
    public function getMigrania(): ?bool
    {
        return $this->migrania;
    }

    /**
     * @param bool $diabetes
     *
     * @return self
     */
    public function setDiabetes(
        bool $diabetes
    ): self {
        $this->diabetes = $diabetes;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDiabetes(): ?bool
    {
        return $this->diabetes;
    }

    /**
     * @param bool $celiaco
     *
     * @return self
     */
    public function setCeliaco(
        bool $celiaco
    ): self {
        $this->celiaco = $celiaco;

        return $this;
    }

    /**
     * @return bool
     */
    public function getCeliaco(): ?bool
    {
        return $this->celiaco;
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
}
