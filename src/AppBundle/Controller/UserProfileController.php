<?php

namespace AppBundle\Controller;



use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\VarDumper\VarDumper;

class UserProfileController extends Controller
{
    public function ShowProfileAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);

        $userform = $this->createFormBuilder($user)
            ->add('username', TextType::class, array(
                'label' => 'Nume Utilizator Nou:'
            ))
            ->add('email', EmailType::class, array(
                'label' => 'introdu eMail nou'
            ))
            ->add('news', CheckboxType::class, array(
                'label'    => 'Vrei Stiri?',
                'required' => false,
            ))
            ->add('picture', ElFinderType::class, array(
                'instance'=>'form',
                'enable'=>true,
                'label' => 'selecteaza foto utilizator',

                ))
            ->getForm();

        $userform->handleRequest($request);


        if ($userform->isSubmitted() && $userform->isValid()) {
            $em->flush();
            return $this->redirectToRoute('profile', [
                'id' => $id
            ]);
        }



        return $this->render('Grunt/pages/profile.html.twig',[

            'user' => $user,
            'userForm' => $userform->createView(),
        ]);

    }

}