<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 08.12.2016
 * Time: 11:40
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


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
     * @ORM\Column(type="string")
     */
    private $comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string")
     */
    private $comment_category;

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