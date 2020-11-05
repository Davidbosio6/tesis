<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Year.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="year")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\YearRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Year
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
     * @var Shift
     *
     * @ORM\OneToMany(targetEntity="Shift", mappedBy="year")
     *
     * @Assert\Count(min=1)
     */
    private $shifts;

    public function __construct()
    {
        $this->shifts = new ArrayCollection();
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
     * @param Shift $shift
     *
     * @return self
     */
    public function addShift(Shift $shift): self
    {
        $this->shifts[] = $shift;
        $shift->setYear($this);

        return $this;
    }

    /**
     * @param Shift $shift
     */
    public function removeShift(Shift $shift)
    {
        $this->shifts->removeElement($shift);
        $shift->setYear(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getShifts()
    {
        return $this->shifts;
    }
}
