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
    public  function findAllComments()
    {
        return $this->createQueryBuilder('comment_repository')
            ->orderBy('comment_repository.comment_date', 'DESC')
            ->getQuery()
            ->execute();
    }
}