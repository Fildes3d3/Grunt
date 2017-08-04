<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 07.12.2016
 * Time: 10:36
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class RegisterController extends Controller
{
    public function registerAction(Request $request)
    {
        $isRegisterSubmit =  $request->isMethod('POST');
        if ($isRegisterSubmit) {
            $username = $request->request->get('_username');
            $password = $request->request->get('_unsafePassword');
            $confirmPassword = $request->request->get('confirmPassword');
            $email = $request->request->get('email');
            $news = $request->request->getBoolean('news');
            $registreduser = $this->getDoctrine()->getRepository('AppBundle:User')
                                    ->findOneBy(array('username' => $username ));
            $registredemail = $this->getDoctrine()->getRepository('AppBundle:User')
                                    ->findOneBy(array('email' => $email ));

            if ($registreduser OR $registredemail) {
                $this->addFlash(
                    'notice',
                    'Prietene... Deja exista un utilizator cu datele astea... Mai incerci ?...Sigur ?!'
                );
                return $this->render(':Grunt:register.html.twig');
            } elseif ($password !== $confirmPassword) {
                $this->addFlash(
                    'notice',
                    'Vezi ca nu ai nimerit... -Parola- , difera de -Reintroduceti Parola-'
                );
                return $this->render(':Grunt:register.html.twig');

            } elseif ($username == $password) {
                $this->addFlash(
                    'notice',
                    'Nu e chiar ok ca parola sa fie aceeasi cu numele... Mai incearca odata :) '
                );

                return $this->render('Grunt/pages/register.html.twig');
            }

            $user = new User();
            $user->setUsername($username);
            $user->setUnsafePassword($password);
            $user->setEmail($email);
            $user->setNews($news);
            $user->setPicture('/images/no_photo.png');

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()
                    ->add('succes', 'Noah draga '. $user->getUsername() . ' ai reusit, de amu poti comenta...');

            return $this->get('security.authentication.guard_handler')
               ->authenticateUserAndHandleSuccess(
                   $user,
                   $request,
                   $this->get('app.security.login_form_authenticator'),
                   'main'
               );

        }

        return $this->render('Grunt/pages/register.html.twig');
    }
}