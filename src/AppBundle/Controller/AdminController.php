<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 10.12.2016
 * Time: 14:29
 */

namespace AppBundle\Controller;


use AppBundle\Form\ArticleForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function newArticleAction()
    {
        $form = $this->createForm(ArticleForm::class);

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:admin.html.twig', ['articleForm' => $form->createView()]);
    }
}