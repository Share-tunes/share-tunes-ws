<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * User
 *
 * @ORM\Table(name="user",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="one_person", columns={"lastName", "firstName"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=100)
     *
     * @Expose
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=100)
     *
     * @Expose
     */
    private $firstName;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get the formatted name to display (NAME Firstname or username)
     *
     * @param $separator: the separator between name and firstname (default: ' ')
     * @return String
     * @VirtualProperty
     */
    public function getUsedName($separator = ' '){
        if($this->getLastName()!=null && $this->getFirstName()!=null){
            return ucfirst(strtolower($this->getFirstName())).$separator.strtoupper($this->getLastName());
        }
        else{
            return "NoName";
        }
    }
}

