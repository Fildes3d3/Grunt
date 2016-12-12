<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 06.12.2016
 * Time: 16:07
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GruntController extends Controller
{
    public function showAction( Request $request)
    {
        $url = explode("/",$request->getPathInfo());

        if (in_array($url['1'], ['garaj', 'diy', 'jurnal', 'contact'])) {
            $cat = $url['1'];
            $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
                ->findAllCommentsLimit($cat);
        }else{
            $cat = 'home';
            $comments = null;
        }
        $categories = ['garaj', 'diy', 'jurnal'];
        $key = array_search($cat, $categories);
        unset($categories[$key]);
        $side = array_values($categories);


        $articlesMain = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit($cat);
        $articlesSide = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit($side['0']);
        $articlesAside = $this->getDoctrine()->getRepository('AppBundle:Article')
            ->findAllArticlesLimit($side['1']);





        return $this->render(':Grunt:garaj.html.twig', [
            'comments' => $comments,
            'Main' => $articlesMain,
            'Side' => $articlesSide,
            'Aside' => $articlesAside,
            'category' => ucfirst($cat),
        ]);
    }

}