<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Classroom.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="classroom")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClassroomRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Classroom
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
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @var Shift
     *
     * @ORM\ManyToOne(targetEntity="Shift", inversedBy="classrooms")
     * @ORM\JoinColumn(name="shift_id", referencedColumnName="id", nullable=true)
     */
    private $shift;

    /**
     * @var Student[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Student", mappedBy="classroom")
     */
    private $students;

    /**
     * @var Calendar
     *
     * @ORM\OneToOne(targetEntity="Calendar", inversedBy="classroom", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="calendar_id", referencedColumnName="id", nullable=true)
     */
    private $calendar;

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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(
        string $description = null
    ): self {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param int $capacity
     *
     * @return self
     */
    public function setCapacity(
        int $capacity
    ): self {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    /**
     * @param Shift|null $shift
     *
     * @return self
     */
    public function setShift(
        Shift $shift = null
    ): self {
        $this->shift = $shift;

        return $this;
    }

    /**
     * @return Shift|null
     */
    public function getShift(): ?Shift
    {
        return $this->shift;
    }

    /**
     * @param Student $student
     *
     * @return self
     */
    public function addStudent(Student $student): self
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
     * @param Calendar|null $calendar
     *
     * @return self
     */
    public function setCalendar(
        Calendar $calendar = null
    ): self {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * @return Calendar|null
     */
    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    public function __toString(): string
    {
     return $this->id;
    }
}
