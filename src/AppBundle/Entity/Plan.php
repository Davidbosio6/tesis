<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Plan.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Plan
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
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description1;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description2;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $showPlan;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHighlighted;

    /**
     * @var Student[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Student", mappedBy="plan")
     */
    private $students;

    public function __construct()
    {
         $this->students = new ArrayCollection();
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
     * @param string $name
     *
     * @return self
     */
    public function setName(
        string $name
    ): self {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription(
        string $description
    ): self {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description1
     *
     * @return self
     */
    public function setDescription1(
        string $description1 = null
    ): self {
        $this->description1 = $description1;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    /**
     * @param string|null $description2
     *
     * @return self
     */
    public function setDescription2(
        string $description2 = null
    ): self {
        $this->description2 = $description2;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription2(): ?string
    {
        return $this->description2;
    }

    /**
     * @param Student $student
     *
     * @return self
     */
    public function addStudent(Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * @param Student $student
     */
    public function removeStudent(Student $student)
    {
        $this->students->removeElement($student);
    }

    /**
     * @return ArrayCollection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param string $amount
     *
     * @return self
     */
    public function setAmount(
        string $amount
    ): self {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     */
    public function getAmount(): ?string
    {
        return $this->amount;
    }

    /**
     * @param string $showPlan
     *
     * @return self
     */
    public function setShowPlan(
        string $showPlan
    ): self {
        $this->showPlan = $showPlan;

        return $this;
    }

    /**
     * @return string
     */
    public function getShowPlan(): ?string
    {
        return $this->showPlan;
    }

    /**
     * @param string $isHighlighted
     *
     * @return self
     */
    public function setIsHighLighted(
        string $isHighlighted
    ): self {
        $this->isHighlighted = $isHighlighted;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsHighLighted(): ?string
    {
        return $this->isHighlighted;
    }
}
