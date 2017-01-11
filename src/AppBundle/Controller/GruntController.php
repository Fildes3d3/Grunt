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
            $limit = 1;
        }else{
            $cat = 'garaj';
            $page = 'home';
            $comments = null;
            $limit = 2;
        }
        $categories = ['garaj', 'diy', 'jurnal'];
        $key = array_search($cat, $categories);
        unset($categories[$key]);
        $side = array_values($categories);

        $articlesMain = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit($cat, $limit);
        $articlesSide = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit($side['0'], $limit);
        $articlesAside = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit($side['1'], $limit);
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticles();

        return $this->render(':Grunt:'.$page.'.html.twig', [
            'comments' => $comments,
            'Main' => $articlesMain,
            'Side' => $articlesSide,
            'Aside' => $articlesAside,
            'category' => ucfirst($cat),
            'article' => $articles,
            'foundArticle' => $foundArticle,
        ]);
    }

    public function contactAction ()
    {
        return $this->render('Grunt/contact.html.twig');
    }

}