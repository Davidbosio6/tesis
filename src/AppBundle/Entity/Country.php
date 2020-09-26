<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country.
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getName(): string
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
     * @return Collection
     */
    public function getProvinces()
    {
        return $this->provinces;
    }
}
