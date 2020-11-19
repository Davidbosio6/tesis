<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * @UniqueEntity("email")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class User implements UserInterface, Serializable
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
     * @ORM\Column(type="string", length=254, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="roles", type="json_array")
     *
     * @Assert\NotBlank()
     */
    private $roles;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = true;

    /**
     * @var Teacher
     *
     * @ORM\OneToOne(targetEntity="Teacher", mappedBy="user")
     */
    private $teacher;

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
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(
        string $email
    ): self {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername(
        string $username
    ): self {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword(
        string $password
    ): self {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPlainPassword(
        string $password
    ): self {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * @param bool $isActive
     *
     * @return $this
     */
    public function setIsActive(
        bool $isActive
    ): self {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
    }

    /**
     * @param $serialized
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list ($this->id, $this->username, $this->password) = unserialize(
            $serialized,
            ['allowed_classes' => false]
        );
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @param string $roles
     *
     * @return self
     */
    public function setRoles(
        string $roles
    ): self {
        $this->roles = explode(',', $roles);

        return $this;
    }

    /**
     * @return array|null
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @return null
     */
    public function eraseCredentials()
    {
        return null;
    }

    /**
     * @param Teacher $teacher
     *
     * @return self
     */
    public function setTeacher(
        Teacher $teacher
    ): self {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * @return Teacher
     */
    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }
}
