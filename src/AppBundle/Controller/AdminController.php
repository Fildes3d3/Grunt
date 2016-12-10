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

class AdminController extends Controller
{
    public function newArticle()
    {
        $form = $this->createForm(ArticleForm::class);

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:admin.html.twig', ['articleForm' => $form->createView()]);
    }
}