<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 08.12.2016
 * Time: 11:58
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    public function newCommentAction(Request $request)
    {
        $isCommentSubmit = $request->getPathInfo() == '/comment/garaj';
        if ($isCommentSubmit) {

            $comment_data = [ 'comment' => $_POST['comment'],
                               'comment_cat' => 'garaj'
                            ];

        $comment = new Comment();
        $comment->setComment($comment_data['comment']);
        $comment->setCommentCategory($comment_data['comment_cat']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        /*customize for posting user
        $this->get('session')->getFlashBag()->add('succes', 'Noah draga '. $user->getUsername() . ' ai reusit, de amu poti comenta...');*/
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')->findAll();

        return $this->render(':Grunt:garaj.html.twig', [
            'comments' => $comments
        ]);
        }
        return $this->render(':Grunt:garaj.html.twig');
    }


}