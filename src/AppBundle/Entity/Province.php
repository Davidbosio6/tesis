<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Province.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="province")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProvinceRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Province
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
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="provinces")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $country;

    /**
     * @var City[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="City", mappedBy="province")
     */
    private $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
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
     * @return $this
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
     * @param Country $country
     *
     * @return self
     */
    public function setCountry(
        Country $country
    ): self {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * @param City $city
     *
     * @return self
     */
    public function addCity(City $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * @param City $city
     */
    public function removeCity(City $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * @return ArrayCollection
     */
    public function getProvinces()
    {
        return $this->cities;
    }
}
