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
     * @ORM\Column(type="integer", nullable=false)
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
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $article_date;

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