<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 06.12.2016
 * Time: 16:07
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GruntController extends Controller
{
    public function homeAction()
    {
        $articlesGaraj = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesGarajSectionLimit();
        $articlesDiy = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesDiySectionLimit();
        $articlesJurnal = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesJurnalSectionLimit();

        return $this->render(':Grunt:home.html.twig', [
            'articlesGaraj' => $articlesGaraj,
            'articlesDiy' => $articlesDiy,
            'articlesJurnal' => $articlesJurnal
        ]);
    }
    public function garajAction()
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllCommentsGarajSectionLimit();
        $articlesGaraj = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesGarajSectionLimit();
        $articlesDiy = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesDiySectionLimit();
        $articlesJurnal = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesJurnalSectionLimit();
        return $this->render(':Grunt:garaj.html.twig', [
            'comments' => $comments,
            'articlesGaraj' => $articlesGaraj,
            'articlesDiy' => $articlesDiy,
            'articlesJurnal' => $articlesJurnal
        ]);
    }
    public function jurnalAction()
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllCommentsJurnalSectionLimit();
        $articlesJurnal = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesJurnalSectionLimit();
        return $this->render(':Grunt:jurnal.html.twig', [
            'comments' => $comments,
            'articlesJurnal' => $articlesJurnal
        ]);
    }
    public function diyAction()
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllCommentsDiySectionLimit();
        $articlesDiy = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesDiySectionLimit();
        return $this->render(':Grunt:diy.html.twig', [
            'comments' => $comments,
            'articlesDiy' => $articlesDiy
        ]);
    }

    public function contactAction()
    {
        return $this->render('Grunt/contact.html.twig');
    }

}