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

            $comment_data = trim($_POST['comment']);
            if ($request->getPathInfo() == '/comment/garaj') {
                $comment_cat = 'garaj';
            }elseif ($request->getPathInfo() == '/comment/diy') {
                $comment_cat = 'diy';
            }elseif ($request->getPathInfo() == '/comment/jurnal') {
                $comment_cat = 'jurnal';
            }/*explode pe getpathinfo si det commen_cat pe baza index din explode*/

            $comment_date = new \DateTime('now');

            $pathInfo = $request->getPathInfo();/*might be useles*/
            $requestUri = $request->getRequestUri();/* might be useles*/

            $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);
            $ex_url = explode("/", $url);

            $registredcomment = $this->getDoctrine()->getRepository('AppBundle:Comment')->findOneBy(array('comment' => $comment_data));
            if ($registredcomment) {
                $this->get('session')->getFlashBag()->add(
                    'comment_exist',
                    'Prietene... chiar este nevoie sa te repeti ?!'
                );
                return $this->redirectToRoute('grunt_'.$ex_url[2]);
            }elseif (!$comment_data){
                $this->get('session')->getFlashBag()->add(
                    'comment_exist',
                    'Comentariul fara continut, e ca mancarea fara sare... DEGEABA'
                );
                return $this->redirectToRoute('grunt_'.$ex_url[2]);
            }

        $comment = new Comment();
        $comment->setComment($comment_data['comment']);
        $comment->setCommentCategory($comment_cat);
        $comment->setCommentDate($comment_date);

        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        /*customize for posting user
        $this->get('session')->getFlashBag()->add('succes', 'Noah draga '. $user->getUsername() . ' ai reusit, de amu poti comenta...');*/




        return $this->redirectToRoute('grunt_'.$ex_url[2]);
        }
    }


}