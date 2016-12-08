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
 * @ORM\Entity
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $user_id;

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


    public function getUserId()
    {
        return $this->user_id;
    }


    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


}