<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 06.12.2016
 * Time: 20:28
 */

namespace AppBundle\Security;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuteticator extends AbstractFormLoginAuthenticator
{
    private $em;
    private $router;

    public function __construct(EntityManager $em, RouterInterface $router)
    {

        $this->em = $em;
        $this->router = $router;
    }

    public function getCredentials(Request $request)
    {
        $isLoginSubmit = $request->getPathInfo() == '/login' && $request->isMethod('POST');
        if (!$isLoginSubmit) {
            return ;
        }

        $data = ['username'=>$_POST['_username'], 'password'=>$_POST['_password']];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['username']
        );

        return $data;

    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $username = $credentials['username'];

        return $this->em->getRepository('AppBundle:User')
            ->findOneBy(['username'=> $username]);

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $password = $credentials['password'];

        if ($password == 'parola') {
            return true;
        }
        return false;
    }

    protected function getLoginUrl()
    {
        return $this->router->generate('security_login');
    }

    protected function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('grunt_homepage');
    }
}