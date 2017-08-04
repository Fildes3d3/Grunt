<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 06.12.2016
 * Time: 19:24
 */

namespace AppBundle\Entity;


use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $password;


    private $unsafePassword;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $news;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $picture;

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $roles)){
            $roles[] = 'ROLE_USER';
        }
        return $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {

    }

       public function eraseCredentials()
    {
        $this->unsafePassword = null;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getUnsafePassword()
    {
        return $this->unsafePassword;
    }

    public function setUnsafePassword($unsafePassword)
    {
        $this->unsafePassword = $unsafePassword;
        $this->password = null;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getNews()
    {
        return $this->news;
    }

    public function setNews($news)
    {
        $this->news = $news;
    }

}