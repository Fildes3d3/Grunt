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
        $articles = $em->getRepository('AppBundle:Article')->findAll();
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllComments();
        $responses = $this->getDoctrine()->getRepository('AppBundle:CommentResponse')
            ->findAll();

        $url = $request->get('pagina');

        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM AppBundle:Article a WHERE a.post_category = '$url' ";
        $querry = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $querry,
            $request->query->getInt('page', 1),
           4
        );



        return $this->render('Grunt/content/article.html.twig', [
            'articles' => $articles,
            'responses' => $responses,
            'comments' => $comments,
            'Main' => $pagination,
            'foundArticle' => $foundArticle,
        ]);
    }

    public function homeAction(Request $request)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAll();


        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM AppBundle:Article a ORDER BY a.article_date DESC";
        $querry = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $querry,
            $request->query->getInt('page', 1),
            2
        );


        return $this->render('Grunt/pages/home.html.twig', [
            'Main' => $pagination,
            'articles' => $articles
        ]);
    }

    public function contactAction ()
    {
        return $this->render('Grunt/pages/contact.html.twig');
    }

}
