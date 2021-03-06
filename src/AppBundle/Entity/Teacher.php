<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Teacher.
 *
 * @ORM\HasLifecycleCallbacks
 *
 * @ORM\Table(name="teacher")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeacherRepository")
 *
 * @author David Bosio <dbosio@pagos360.com>
 */
class Teacher
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
     * @ORM\Column(type="string", length=9)
     */
    private $idNumber;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string")
     */
    private $address;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $notes;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="teacher", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *
     */
    private $user;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City", inversedBy="teachers")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $city;

    /**
     * @var Subject
     *
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="teachers")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id", nullable=false)
     *
     * @Assert\NotNull()
     */
    private $subject;

    /**
     * @var Course
     *
     * @ORM\OneToMany(targetEntity="Course", mappedBy="teacher", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id", nullable=true)
     */
    private $courses;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
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
     * @param string $idNumber
     *
     * @return self
     */
    public function setIdNumber(
        string $idNumber
    ): self {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIdNumber(): ?string
    {
        return $this->idNumber;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return self
     */
    public function setFirstName(
        string $firstName
    ): self {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return self
     */
    public function setLastName(
        string $lastName
    ): self {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function setUser(
        User $user
    ): self {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param City $city
     *
     * @return self
     */
    public function setCity(
        City $city
    ): self {
        $this->city = $city;

        return $this;
    }

    /**
     * @return City|null
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @param string $phoneNumber
     *
     * @return self
     */
    public function setPhoneNumber(
        string $phoneNumber
    ): self {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $address
     *
     * @return self
     */
    public function setAddress(
        string $address
    ): self {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param DateTime $birthdate
     *
     * @return self
     */
    public function setBirthdate(
        DateTime $birthdate
    ): self {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getBirthdate(): ?DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param string|null $notes
     *
     * @return self
     */
    public function setNotes(
        string $notes = null
    ): self {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param Subject $subject
     *
     * @return self
     */
    public function setSubject(
        Subject $subject
    ): self {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Subject|null
     */
    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    /**
     * @param string|null $photo
     *
     * @return self
     */
    public function setPhoto(
        string $photo = null
    ): self {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param Course $course
     *
     * @return self
     */
    public function addCourse(Course $course): self
    {
        $this->courses[] = $course;
        $course->setTeacher($this);

        return $this;
    }

    /**
     * @param Course $course
     */
    public function removeCourse(Course $course)
    {
        $this->courses->removeElement($course);
        $course->setTeacher(null);
    }

    /**
     * @return ArrayCollection
     */
    public function getCourses()
    {
        return $this->courses;
    }
}
