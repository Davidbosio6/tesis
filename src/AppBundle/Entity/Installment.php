<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Installment.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="installment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstallmentRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Installment
{

    const PENDING_STATE = 'Pendiente';
    const PAID_STATE = 'Pagada';

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
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @ORM\Column(type="string")
     */
    private $month;

    /**
     * @ORM\Column(type="string")
     */
    private $checkoutUrl;


    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dueDate;

    /**
     * @var Student
     *
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="installments")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id", nullable=false)
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
     * @param string $state
     *
     * @return self
     */
    public function setState(
        string $state
    ): self {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $month
     *
     * @return self
     */
    public function setMonth(
        string $month
    ): self {
        $this->month = $month;

        return $this;
    }

    /**
     * @return string
     */
    public function getMonth(): ?string
    {
        return $this->month;
    }

    /**
     * @param string $checkoutUrl
     *
     * @return self
     */
    public function setCheckoutUrl(
        string $checkoutUrl
    ): self {
        $this->checkoutUrl = $checkoutUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl(): ?string
    {
        return $this->checkoutUrl;
    }

    /**
     * @param DateTime $dueDate
     *
     * @return self
     */
    public function setDueDate(
        DateTime $dueDate
    ): self {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDueDate(): DateTime
    {
        return $this->dueDate;
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
