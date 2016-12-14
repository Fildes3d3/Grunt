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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function newArticleAction(Request $request)
    {
        $form = $this->createForm(ArticleForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $article = $form->getData();

                $image = $article->getPicture();
                $imageName = md5(uniqid()).'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('picture_directory'),
                    $imageName
                );
            $article->setPicture($imageName);

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
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticles();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:list.html.twig', [
            'articles' => $articles,
        ]);
    }

    public function  editArticleAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->findOneById($id);

        $form = $this->createForm(ArticleForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $form->getData();

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

        return $this->redirectToRoute('grunt_list');
    }



    public  function  listUserAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')
            ->findAll();
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:listUsers.html.twig', [
            'users' => $users
        ]);
    }

    public function adminUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);

        $user->setRoles(["","ROLE_ADMIN"]);

        $em->flush();

        return $this->redirectToRoute('grunt_user');
    }

    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneById($id);

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('grunt_user');
    }
}