<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 15.12.2016
 * Time: 11:58
 */

namespace AppBundle\Controller;


use AppBundle\Form\CKeFrom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CKeController extends Controller
{
    public function newPostAction(Request $request)
    {
        $articles = $this->getDoctrine()->getRepository('AppBundle:Article')->findAllArticles();

        $form = $this->createForm(CKeFrom::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute('listTest');
        }


        return $this->render(':Grunt:test.html.twig', [
            'CKeFrom' => $form->createView(),
            'articles' => $articles,
        ]);
    }

    public function showPostAction()
    {
        $data = $this->getDoctrine()->getRepository('AppBundle:Test')
            ->findAll();
        return $this->render(':Grunt:listTest.html.twig', [
            'data' => $data,
        ]);
    }

}