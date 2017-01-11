<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 09.12.2016
 * Time: 16:39
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * @return Article
     */
    public  function findAllArticlesLimit($cat, $limit)
    {
        return $this->createQueryBuilder('article_repository')
            ->andWhere('article_repository.post_category = :post_category')
            ->setParameter('post_category', $cat)
            ->orderBy('article_repository.article_date', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findArticle($id)
    {
        return $this->createQueryBuilder('article_repository')
            ->andWhere('article_repository.post_title = :post_title')
            ->setParameter('post_title', $id)
            ->getQuery()
            ->execute();
    }

    /**
     * @return mixed
     */
    public function findAllArticles()
    {
        return $this->createQueryBuilder('article_repository')
            ->orderBy('article_repository.article_date', 'DESC')
            ->setMaxResults('10')
            ->getQuery()
            ->execute();
    }
}