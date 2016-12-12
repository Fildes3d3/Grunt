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
    public function homeAction(Request $request)
    {
        $url = explode("/",$request->getPathInfo());

        if (in_array($url['1'], ['garaj', 'diy', 'jurnal'])) {
            $cat = $url['1'];
            $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
                ->findAllCommentsLimit($cat);
        }else{
            $cat = 'home';
            $comments = null;
        }

        $articlesGaraj = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit('garaj');
        $articlesDiy = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit('diy');
        $articlesJurnal = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit('jurnal');




        return $this->render(':Grunt:'.$cat.'.html.twig', [
            'comments' => $comments,
            'articlesGaraj' => $articlesGaraj,
            'articlesDiy' => $articlesDiy,
            'articlesJurnal' => $articlesJurnal
        ]);
    }

    public function contactAction()
    {
        return $this->render('Grunt/contact.html.twig');
    }

}