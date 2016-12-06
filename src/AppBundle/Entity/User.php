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
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    private $unsafePassword;

    public function getUsername()
    {
        return $this->username;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
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

    }


    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUnsafePassword()
    {
        return $this->unsafePassword;
    }

    /**
     * @param mixed $unsafePassword
     */
    public function setUnsafePassword($unsafePassword)
    {
        $this->unsafePassword = $unsafePassword;
        $this->password = null;
    }


}