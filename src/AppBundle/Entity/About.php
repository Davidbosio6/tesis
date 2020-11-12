<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class About.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="about")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AboutRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class About
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
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $showAbout;

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
     * @return string
     */
    public function getTittle(): ?string
    {
        return $this->tittle;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(
        string $content
    ): self {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $showAbout
     *
     * @return self
     */
    public function setShowAbout(
        string $showAbout
    ): self {
        $this->showAbout = $showAbout;

        return $this;
    }

    /**
     * @return string
     */
    public function getShowAbout(): ?string
    {
        return $this->showAbout;
    }
}
