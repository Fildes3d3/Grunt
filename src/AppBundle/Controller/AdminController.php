<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 10.12.2016
 * Time: 14:29
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleForm;
use Faker\Provider\cs_CZ\DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class AdminController extends Controller
{
    public function newArticleAction(Request $request)
    {
        $form = $this->createForm(ArticleForm::class);

        $form->handleRequest($request);

        /*$article_date = new \DateTime('now'); = redundant, date is set in the form*/


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

            return $this->redirectToRoute('grunt_admin');
        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:admin.html.twig', ['articleForm' => $form->createView()]);
    }

    public function listArticleAction()
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->finAllArticles();
        return $this->render(':Grunt:list.html.twig', [
            'articles' => $articles
        ]);
    }

    public  function  listUserAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')
            ->findAll();
        return $this->render(':Grunt:listUsers.html.twig', [
            'users' => $users
        ]);
    }
}