<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Calendar.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="calendar")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CalendarRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Calendar
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
    private $googleId;

    /**
     * @var Classroom
     *
     * @ORM\OneToOne(targetEntity="Classroom", mappedBy="calendar")
     */
    private $classroom;

    /**
     * @var Event
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="calendar", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="calendar_id", referencedColumnName="id", nullable=true)
     */
    private $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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
     * @param Classroom|null $classroom
     *
     * @return self
     */
    public function setClassroom(
        Classroom $classroom = null
    ): self {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return Classroom|null
     */
    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    /**
     * @param string $googleId
     *
     * @return self
     */
    public function setGoogleId(
        string $googleId
    ): self {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getGoogleId(): ?string
    {
        return $this->googleId;
    }

    /**
     * @param Event $event
     *
     * @return self
     */
    public function addEvent(Event $event): self
    {
        $this->events[] = $event;
        $event->setCalendar($this);

        return $this;
    }

    /**
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
        $event->setCalendar(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }
}
