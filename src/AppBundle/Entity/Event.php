<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Event.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Event
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
     * @var Calendar
     *
     * @ORM\ManyToOne(targetEntity="Calendar", inversedBy="events")
     */
    private $calendar;

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
     * @param Calendar $calendar
     *
     * @return self
     */
    public function setCalendar(
        Calendar $calendar
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
     * @return DateTime|null
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
     * @return DateTime|null
     */
    public function getEndHour(): ?DateTime
    {
        return $this->endHour;
    }
}
