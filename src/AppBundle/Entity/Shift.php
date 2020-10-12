<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Shift.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="shift")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShiftRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Shift
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
     * @ORM\Column(type="time")
     */
    private $startHour;

    /**
     * @ORM\Column(type="time")
     */
    private $endHour;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $notes;

    /**
     * @var Classroom
     *
     * @ORM\ManyToMany(targetEntity="Classroom", mappedBy="shifts")
     *
     * @Assert\Count(min=1)
     */
    private $classrooms;


    public function __construct()
    {
        $this->classrooms = new ArrayCollection();
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
     * @param DateTime $startHour
     *
     * @return self
     */
    public function setStartHour(
        DateTime $startHour
    ): self {
        $this->startHour = $startHour;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartHour(): ?DateTime
    {
        return $this->startHour;
    }

    /**
     * @param DateTime $endHour
     *
     * @return self
     */
    public function setEndHour(
        DateTime $endHour
    ): self {
        $this->endHour = $endHour;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndHour(): ?DateTime
    {
        return $this->endHour;
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
     * @param array $classrooms
     *
     * @return self
     */
    public function addClassroom(array $classrooms): self
    {

        foreach ($classrooms as $classroom){
            $this->classrooms[] = $classroom;
            $classroom->addShift($this);
        }

        return $this;
    }

    /**
     * @param Classroom $classroom
     */
    public function removeClassroom(Classroom $classroom)
    {
        $this->classrooms->removeElement($classroom);
        $classroom->removeShift($this);
    }

    /**
     * @return ArrayCollection
     */
    public function getClassrooms()
    {
        return $this->classrooms;
    }
}
