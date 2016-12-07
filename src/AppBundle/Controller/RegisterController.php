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

            $userdata = ['username' => $_POST['_username'],
                'password' => $_POST['_unsafePassword'],
                'confirm' => $_POST['confirmPassword'],
                'email' => $_POST['email'],
                'news' => $_POST['news']
            ];


            $registredemail = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(array('email' => $userdata['email']));

            if ($registredemail) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Prietene... Deja exista un utilizator cu emailu asta... Mai incerci ?...Sigur ?!'
                );
                return $this->render(':Grunt:register.html.twig');
            } elseif ($userdata['password'] !== $userdata['confirm']) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Vezi ca nu ai nimerit... -Parola- , difera de -Reintroduceti Parola-'
                );
                return $this->render(':Grunt:register.html.twig');
            } elseif ($userdata['username'] == $userdata['password']) {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Nu e chiar ok ca parola sa fie aceeasi cu numele... Mai incearca odata :) '
                );
                return $this->render(':Grunt:register.html.twig');
            }



            $user = new User();
            $user->setUsername($userdata['username']);
            $user->setUnsafePassword($userdata['password']);
            $user->setEmail($userdata['email']);
            $user->setNews($userdata['news']);



            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('succes', 'Noah draga '. $user->getUsername() . ' ai reusit, de amu poti comenta...');

            return $this->get('security.authentication.guard_handler')
               ->authenticateUserAndHandleSuccess(
                   $user,
                   $request,
                   $this->get('app.security.login_form_authenticator'),
                   'main'
               );

        }
        return $this->render(':Grunt:register.html.twig');
    }

}