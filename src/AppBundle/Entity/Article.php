<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 10.12.2016
 * Time: 14:10
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $post_category;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $post_title;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $post_data;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(mimeTypes={"image/jpg", "image/jpeg" })
     */
    private $picture;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $article_date;

    /**
     * @ORM\Column(type="string")
     */
    private $article_caption;

    /**
     * @ORM\Column(type="string")
     */
    private $picture_caption;

    /**
     * @return mixed
     */
    public function getPictureCaption()
    {
        return $this->picture_caption;
    }

    /**
     * @param mixed $picture_caption
     */
    public function setPictureCaption($picture_caption)
    {
        $this->picture_caption = $picture_caption;
    }

    /**
     * @return mixed
     */
    public function getArticleCaption()
    {
        return $this->article_caption;
    }

    /**
     * @param mixed $article_caption
     */
    public function setArticleCaption($article_caption)
    {
        $this->article_caption = $article_caption;
    }

    /**
     * @return mixed
     */
    public function getArticleDate()
    {
        return $this->article_date;
    }

    /**
     * @param mixed $article_date
     */
    public function setArticleDate($article_date)
    {
        $this->article_date = $article_date;
    }


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



    /**
     * @return mixed
     */
    public function getPostCategory()
    {
        return $this->post_category;
    }

    /**
     * @param mixed $post_category
     */
    public function setPostCategory($post_category)
    {
        $this->post_category = $post_category;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * @param mixed $post_title
     */
    public function setPostTitle($post_title)
    {
        $this->post_title = $post_title;
    }

    /**
     * @return mixed
     */
    public function getPostData()
    {
        return $this->post_data;
    }

    /**
     * @param mixed $post_data
     */
    public function setPostData($post_data)
    {
        $this->post_data = $post_data;
    }


}