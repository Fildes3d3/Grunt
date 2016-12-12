<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 09.12.2016
 * Time: 16:39
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    /**
     * @return Comment
     */
    public  function findAllCommentsLimit($cat)
    {
        return $this->createQueryBuilder('comment_repository')
            ->andWhere('comment_repository.comment_category = :comment_category')
            ->setParameter('comment_category', $cat)
            ->orderBy('comment_repository.comment_date', 'DESC')
            ->setMaxResults('3')
            ->getQuery()
            ->execute();

    }
}