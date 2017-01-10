<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 08.12.2016
 * Time: 11:58
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Comment;
use AppBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Snipe\BanBuilder\CensorWords;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentController extends Controller
{
    public function newCommentAction($page,  Request $request)
    {
        $isCommentSubmit = $request->isMethod('POST');

        if ($isCommentSubmit) {

            $url = explode("/",$request->getPathInfo());
            $comment_data = trim($request->request->get('comment'));

            //start censorship
            $censor = new CensorWords;
            $langs = array('fr','it', 'en-us', 'en-uk', 'ro');
            $badwords = $censor->setDictionary($langs);
            $censor->setReplaceChar("@*!^%#");
            $string = $censor->censorString($comment_data);
            //end censorship
            $articleId = $request->request->get('articleId');


            if (in_array($url['2'], ['garaj', 'diy', 'jurnal'])) {
                $comment_cat = $url['2'];
            }

            $comment_date = new \DateTime('now');

            $registredcomment = $this->getDoctrine()->getRepository('AppBundle:Comment')->findOneBy(array('comment' => $comment_data));
            if ($registredcomment) {
                $this->addFlash(
                    'comment_exist',
                    'Prietene... chiar este nevoie sa te repeti ?!'
                );
                return $this->redirectToRoute('grunt_article', array('page' => $comment_cat, 'id' => $articleId));
            }elseif (!$comment_data){
                $this->addFlash(
                    'comment_exist',
                    'Comentariul fara continut, e ca mancarea fara sare... DEGEABA'
                );
                return $this->redirectToRoute('grunt_article', array('page' => $comment_cat, 'id' => $articleId));
            }

        $comment = new Comment();
        $comment->setComment($string["clean"]);
        $comment->setCommentCategory($comment_cat);
        $comment->setCommentDate($comment_date);
        $comment->setUser($this->getUser());
        $comment->setArticleId($articleId);


        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash('succes', 'Bravo '. $this->getUser()->getUsername() . ' ai reusit, sa comentezi...');




        return $this->redirectToRoute('grunt_article', array('page' => $comment_cat, 'id' => $articleId));
        }
    }

    public function listCommentAction() {

        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllComments();

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Grunt/listComments.html.twig', [
            'comments' => $comments,
        ]);

    }

    public function editCommentAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')
            ->findAllComments();

        $comment = $em->getRepository('AppBundle:Comment')->findOneById($id);

        $form = $this->createFormBuilder($comment)
            ->add('comment', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $em->flush();
            return $this->redirectToRoute('comment_list');

        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render(':Grunt:editComments.html.twig', [
            'commentForm' => $form->createView(),
        ]);
    }

    public function deleteCommentAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $comment = $em->getRepository('AppBundle:Comment')->findOneById($id);
        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('comment_list');

    }

}