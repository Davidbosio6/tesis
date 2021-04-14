<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

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
    const EXPIRED_STATE = 'Vencida';

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
     * @ORM\Column(type="integer")
     */
    private $month;

    /**
     * @ORM\Column(type="integer")
     */
    private $transactionId;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $re_estimated = false;

    /**
     * @ORM\Column(type="string")
     */
    private $checkoutUrl;

    /**
     * @ORM\Column(type="string")
     */
    private $pdfUrl;

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
     * @param int $month
     *
     * @return self
     */
    public function setMonth(
        int $month
    ): self {
        $this->month = $month;

        return $this;
    }

    /**
     * @return int
     */
    public function getMonth(): ?int
    {
        return $this->month;
    }

    /**
     * @param int $transactionId
     *
     * @return self
     */
    public function setTransactionId(
        int $transactionId
    ): self {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * @return int
     */
    public function getTransactionId(): ?int
    {
        return $this->transactionId;
    }

    /**
     * @param bool $re_estimated
     *
     * @return self
     */
    public function setReEstimated(
        bool $re_estimated
    ): self {
        $this->re_estimated = $re_estimated;

        return $this;
    }

    /**
     * @return bool
     */
    public function getReEstimated(): ?bool
    {
        return $this->re_estimated;
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
     * @param string $pdfUrl
     *
     * @return self
     */
    public function setPdfUrl(
        string $pdfUrl
    ): self {
        $this->pdfUrl = $pdfUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getPdfUrl(): ?string
    {
        return $this->pdfUrl;
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
