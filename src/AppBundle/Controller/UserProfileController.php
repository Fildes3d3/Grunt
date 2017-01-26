<?php

namespace AppBundle\Controller;



use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class UserProfileController extends Controller
{
    public function ShowProfileAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('news', CheckboxType::class, array(
                'label'    => 'Vrei Stiri?',
                'required' => false,
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('profile', [
                'id' => $id
            ]);

        }

        return $this->render('Grunt/profile.html.twig',[

            'user' => $user,
            'userForm' => $form->createView(),
        ]);

    }


}