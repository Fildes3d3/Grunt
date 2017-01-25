<?php

namespace AppBundle\Controller;



use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserProfileController extends Controller
{
    public function ShowProfileAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);



        return $this->render('Grunt/profile.html.twig',[

            'user' => $user
        ]);

    }
}