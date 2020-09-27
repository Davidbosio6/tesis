<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Country
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
     * @var Province[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Province", mappedBy="country")
     */
    private $provinces;

    public function __construct()
    {
        $this->provinces = new ArrayCollection();
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
     * @param Province $province
     *
     * @return self
     */
    public function addProvince(Province $province)
    {
        $this->provinces[] = $province;

        return $this;
    }

    /**
     * @param Province $province
     */
    public function removeProvince(Province $province)
    {
        $this->provinces->removeElement($province);
    }

    /**
     * @return ArrayCollection
     */
    public function getProvinces()
    {
        return $this->provinces;
    }
}
