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
    public  function findAllArticlesLimit($cat)
    {
        return $this->createQueryBuilder('article_repository')
            ->andWhere('article_repository.post_category = :post_category')
            ->setParameter('post_category', $cat)
            ->orderBy('article_repository.article_date', 'DESC')
            ->setMaxResults('1')
            ->getQuery()
            ->execute();

    }

    public function finAllArticles()
    {
        return $this->createQueryBuilder('article_repository')
            ->orderBy('article_repository.article_date', 'DESC')
            ->setMaxResults('10')
            ->getQuery()
            ->execute();
    }
}