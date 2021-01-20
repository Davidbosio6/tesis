<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ProgressHistory.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="progress_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgressHistoryRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class ProgressHistory
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
    private $tittle;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="progressHistories")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $student;

    /**
     * Gets triggered every time on persist.
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {

        if (empty($this->createdAt)) {
            $this->createdAt = new DateTime();
        }

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
     * @param DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(
        DateTime $createdAt
    ): self {
        $this->createdAt = $createdAt;

        return $this;
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
     * @param string $tittle
     *
     * @return self
     */
    public function setTittle(
        string $tittle
    ): self {
        $this->tittle = $tittle;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTittle(): ?string
    {
        return $this->tittle;
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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
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
     * @return Student|null
     */
    public function getStudent (): ?Student
    {
        return $this->student;
    }
}
