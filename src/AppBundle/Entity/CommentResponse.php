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
 * @ORM\Table(name="commentresponse")
 */
class CommentResponse
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
    private $commentresponse;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $articleId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Comment")
     * @ORM\JoinColumn(nullable=false, onDelete="cascade")
     */
    private $commentId;

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
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @param mixed $articleId
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
    }

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
    }/**
 * @return mixed
 */
public function getCommentresponse()
{
    return $this->commentresponse;
}/**
 * @param mixed $commentresponse
 */
public function setCommentresponse($commentresponse)
{
    $this->commentresponse = $commentresponse;
}/**
 * @return mixed
 */
public function getCommentId()
{
    return $this->commentId;
}/**
 * @param mixed $commentId
 */
public function setCommentId(Comment $commentId)
{
    $this->commentId = $commentId;
}




}