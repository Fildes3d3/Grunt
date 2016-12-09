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
        $isCommentSubmit = $request->isMethod('POST');

        if ($isCommentSubmit) {

            $url = explode("/",$request->getPathInfo());

            $comment_data = trim($_POST['comment']);

            if (in_array($url['2'], ['garaj', 'diy', 'jurnal'])) {
                $comment_cat = $url['2'];
            }
            /*if ($url['2'] == 'garaj') {
                $comment_cat = 'garaj';
            }elseif ($url['2'] == 'diy') {
                $comment_cat = 'diy';
            }elseif ($url['2'] == 'jurnal') {
                $comment_cat = 'jurnal';
            }*/

            $comment_date = new \DateTime('now');

            $registredcomment = $this->getDoctrine()->getRepository('AppBundle:Comment')->findOneBy(array('comment' => $comment_data));
            if ($registredcomment) {
                $this->get('session')->getFlashBag()->add(
                    'comment_exist',
                    'Prietene... chiar este nevoie sa te repeti ?!'
                );
                return $this->redirectToRoute('grunt_'.$url[2]);
            }elseif (!$comment_data){
                $this->get('session')->getFlashBag()->add(
                    'comment_exist',
                    'Comentariul fara continut, e ca mancarea fara sare... DEGEABA'
                );
                return $this->redirectToRoute('grunt_'.$url[2]);
            }

        $comment = new Comment();
        $comment->setComment($comment_data);
        $comment->setCommentCategory($comment_cat);
        $comment->setCommentDate($comment_date);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        /*customize for posting user
        $this->get('session')->getFlashBag()->add('succes', 'Noah draga '. $user->getUsername() . ' ai reusit, de amu poti comenta...');*/




        return $this->redirectToRoute('grunt_'.$url[2]);
        }
    }


}