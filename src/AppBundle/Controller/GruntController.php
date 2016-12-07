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
        return $this->render('Grunt/garaj.html.twig');
    }
    public function jurnalAction()
    {
        return $this->render('Grunt/jurnal.html.twig');
    }
    public function diyAction()
    {
        return $this->render('Grunt/diy.html.twig');
    }
    public function contactAction()
    {
        return $this->render('Grunt/contact.html.twig');
    }
    /*public function registerAction()
    {
        return $this->render('Grunt/register.html.twig');
    }*/
    public function adminAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Grunt/admin.html.twig');
    }
}