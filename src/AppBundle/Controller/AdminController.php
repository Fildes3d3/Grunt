<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 10.12.2016
 * Time: 14:29
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use AppBundle\Form\ArticleForm;
use Faker\Provider\cs_CZ\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;




class AdminController extends Controller
{
    public function newArticleAction(Request $request)
    {
        $form = $this->createForm(ArticleForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash('succes', 'Articol postat in categoria '
                . $article->getPostCategory().
                ' verifica pagina de destinatie pentru confirmare');

            return $this->redirectToRoute('grunt_list');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:admin.html.twig', ['articleForm' => $form->createView()]);
    }

    public function listArticleAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAll();
        return $this->render(':Grunt:list.html.twig', [
            'articles' => $articles,
        ]);
    }

    public function  editArticleAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->findOneById($id);
        $form = $this->createForm(ArticleForm::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $this->addFlash('succes', 'Articol modificat articolul '. $article->getPostTitle() .' in categoria '
                . $article->getPostCategory().
                ' verifica pagina de destinatie pentru confirmare');

            $em->flush();
            return $this->redirectToRoute('grunt_list');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:admin.html.twig', [
            'articleForm' => $form->createView(),
            'article' => $article
        ]);

    }

    public function deleteArticleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->findOneById($id);
        $em->remove($article);
        $em->flush();

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->redirectToRoute('grunt_list');
    }



    public  function  listUserAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')
            ->findAll();
        $this->denyAccessUnlessGranted('ROLE_BOSS');
        return $this->render(':Grunt:listUsers.html.twig', [
            'users' => $users
        ]);
    }

    public function adminUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);
        $user->setRoles(["ROLE_ADMIN"]);
        $em->flush();

        $this->denyAccessUnlessGranted('ROLE_BOSS');
        return $this->redirectToRoute('grunt_user');
    }

    public function standardUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);
        $user->setRoles(["ROLE_USER"]);
        $em->flush();

        $this->denyAccessUnlessGranted('ROLE_BOSS');
        return $this->redirectToRoute('grunt_user');
    }

    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);
        $em->remove($user);
        $em->flush();

        $this->denyAccessUnlessGranted('ROLE_BOSS');
        return $this->redirectToRoute('grunt_user');
    }
}