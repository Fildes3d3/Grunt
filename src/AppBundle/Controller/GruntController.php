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
        return $this->render(':Grunt:home.html.twig');
    }
    public function garajAction()
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllCommentsGarajSectionLimit();
        return $this->render(':Grunt:garaj.html.twig', [
            'comments' => $comments
        ]);
    }
    public function jurnalAction()
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllCommentsJurnalSectionLimit();
        return $this->render(':Grunt:jurnal.html.twig', [
            'comments' => $comments
        ]);
    }
    public function diyAction()
    {
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllCommentsDiySectionLimit();
        return $this->render(':Grunt:diy.html.twig', [
            'comments' => $comments
        ]);
    }
    public function contactAction()
    {
        return $this->render('Grunt/contact.html.twig');
    }
    public function adminAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Grunt/admin.html.twig');
    }
}