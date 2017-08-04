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

            return $this->redirectToRoute('article_list');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Grunt/adminarea/pages/newarticle.html.twig', ['articleForm' => $form->createView()]);
    }

    public function listArticleAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM AppBundle:Article a";
        $querry = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $querry,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('Grunt/adminarea/pages/articlelist.html.twig', [
            'pagination' => $pagination
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
            return $this->redirectToRoute('article_list');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Grunt/adminarea/pages/newarticle.html.twig', [
            'articleForm' => $form->createView(),
            'article' => $article
        ]);

    }

    public function  viewArticleAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->findOneById($id);

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Grunt/adminarea/pages/viewarticle.html.twig', [
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
        return $this->redirectToRoute('article_list');
    }



    public  function  listUserAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_BOSS');

        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM AppBundle:USER a";
        $querry = $em->createQuery($dql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $querry,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('Grunt/adminarea/pages/userlist.html.twig', [

            'pagination' => $pagination
        ]);
    }

    public function adminUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);
        $user->setRoles(["ROLE_ADMIN"]);
        $em->flush();

        $this->denyAccessUnlessGranted('ROLE_BOSS');
        return $this->redirectToRoute('user_list');
    }

    public function standardUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);
        $user->setRoles(["ROLE_USER"]);
        $em->flush();

        $this->denyAccessUnlessGranted('ROLE_BOSS');
        return $this->redirectToRoute('user_list');
    }

    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);
        $em->remove($user);
        $em->flush();

        $this->denyAccessUnlessGranted('ROLE_BOSS');
        return $this->redirectToRoute('user_list');
    }
}