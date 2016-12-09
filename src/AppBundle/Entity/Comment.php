<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 08.12.2016
 * Time: 11:40
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", unique=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $comment_category;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $comment_date;

    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        return $this->comment_date;
    }

    /**
     * @param mixed $comment_date
     */
    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    /**
     * @return mixed
     */
    public function getCommentCategory()
    {
        return $this->comment_category;
    }

    /**
     * @param mixed $comment_category
     */
    public function setCommentCategory($comment_category)
    {
        $this->comment_category = $comment_category;
    }


    public function getComment()
    {
        return $this->comment;
    }


    public function setComment($comment)
    {
        $this->comment = $comment;
    }

}