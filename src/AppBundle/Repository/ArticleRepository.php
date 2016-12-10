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
    public  function findAllArticlesGarajSectionLimit()
    {
        return $this->createQueryBuilder('article_repository')
            ->andWhere('article_repository.post_category = :post_category')
            ->setParameter('post_category', 'garaj')
            ->orderBy('article_repository.article_date', 'DESC')
            ->setMaxResults('1')
            ->getQuery()
            ->execute();

    }

    /**
     * @return Article
     */
    public  function findAllArticlesDiySectionLimit()
    {
        return $this->createQueryBuilder('article_repository')
            ->andWhere('article_repository.post_category = :post_category')
            ->setParameter('post_category', 'diy')
            ->orderBy('article_repository.article_date', 'DESC')
            ->setMaxResults('1')
            ->getQuery()
            ->execute();

    }

    /**
     * @return Article
     */
    public  function findAllArticlesJurnalSectionLimit()
    {
        return $this->createQueryBuilder('article_repository')
            ->andWhere('article_repository.post_category = :post_category')
            ->setParameter('post_category', 'jurnal')
            ->orderBy('article_repository.article_date', 'DESC')
            ->setMaxResults('1')
            ->getQuery()
            ->execute();

    }
}