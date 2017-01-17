<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 06.12.2016
 * Time: 16:07
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GruntController extends Controller
{
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $foundArticle = $em->getRepository('AppBundle:Article')->findOneById($id);
        $url = explode("/",$request->getPathInfo());
        if (in_array($url['1'], ['garaj', 'diy', 'jurnal', 'contact'])) {
            $cat = $url['1'];
            $page = 'garaj';
            $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
                ->findAllCommentsLimit($cat);
            $responses = $this->getDoctrine()->getRepository('AppBundle:CommentResponse')
                ->findAll();
        }else{
            $cat = 'garaj';
            $page = 'home';
            $comments = null;
            $responses = null;

        }

        $articlesMain = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAll();

        return $this->render(':Grunt:'.$page.'.html.twig', [
            'responses' => $responses,
            'comments' => $comments,
            'Main' => $articlesMain,
            'foundArticle' => $foundArticle,
        ]);
    }

    public function contactAction ()
    {
        return $this->render('Grunt/contact.html.twig');
    }

}