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
            $comment_data = trim($request->request->get('comment'));

            if (in_array($url['2'], ['garaj', 'diy', 'jurnal'])) {
                $comment_cat = $url['2'];
            }

            $comment_date = new \DateTime('now');

            $registredcomment = $this->getDoctrine()->getRepository('AppBundle:Comment')->findOneBy(array('comment' => $comment_data));
            if ($registredcomment) {
                $this->addFlash(
                    'comment_exist',
                    'Prietene... chiar este nevoie sa te repeti ?!'
                );
                return $this->redirectToRoute('grunt_'.$url[2]);
            }elseif (!$comment_data){
                $this->addFlash(
                    'comment_exist',
                    'Comentariul fara continut, e ca mancarea fara sare... DEGEABA'
                );
                return $this->redirectToRoute('grunt_'.$url[2]);
            }

        $comment = new Comment();
        $comment->setComment($comment_data);
        $comment->setCommentCategory($comment_cat);
        $comment->setCommentDate($comment_date);
        $comment->setUser($this->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash('succes', 'Bravo '. $this->getUser()->getUsername() . ' ai reusit, sa comentezi...');




        return $this->redirectToRoute('grunt_'.$url[2]);
        }
    }


}