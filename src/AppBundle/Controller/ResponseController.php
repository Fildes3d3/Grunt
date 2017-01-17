<?php
/**
 * Created by PhpStorm.
 * User: fildes
 * Date: 08.12.2016
 * Time: 11:58
 */

namespace AppBundle\Controller;


use AppBundle\Entity\CommentResponse;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Article;
use AppBundle\Controller\CommentController;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Snipe\BanBuilder\CensorWords;


class ResponseController extends Controller
{
    public function newCommentResponseAction(Request $request)
    {
        $isResponseSubmit = $request->isMethod('POST');

        if ($isResponseSubmit) {

            $url = explode("/",$request->getPathInfo());
            $response_data = trim($request->request->get('comment-response'));

            //start censorship
            $censor = new CensorWords;
            $badwords = $censor->setDictionary('../src/AppBundle/Dict/ro.php');
            $censor->setReplaceChar("@*!^%#");
            $string = $censor->censorString($response_data);
            //end censorship

            $articleId = $request->request->get('articleId');
            $commentId = $request->request->get('commentId');

            if (in_array($url['2'], ['garaj', 'diy', 'jurnal'])) {
                $response_cat = $url['2'];
            }


            $response_date = new \DateTime('now');

            $registredresponse = $this->getDoctrine()->getRepository('AppBundle:CommentResponse')
                ->findOneBy(array('commentresponse' => $response_data));

            if ($registredresponse) {
                $this->addFlash(
                    'comment_exist',
                    'Prietene... chiar este nevoie sa te repeti ?!'
                );

                return $this->redirectToRoute('grunt_article', array('page' => $comment_cat, 'id' => $articleId));

            }elseif (!$response_data){
                $this->addFlash(
                    'comment_exist',
                    'Comentariul fara continut, e ca mancarea fara sare... DEGEABA'
                );

                return $this->redirectToRoute('grunt_article', array('page' => $response_cat, 'id' => $articleId));
            }
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            $response = new CommentResponse();
            $response->setCommentresponse($string["clean"]);
            $response->setCommentCategory($response_cat);
            $response->setCommentDate($response_date);
            $response->setUser($this->getUser());
            $response->setArticleId($articleId);
            $response->setCommentId($em->getReference('AppBundle:Comment', $commentId));


            $em->persist($response);
        $em->flush();

        $this->addFlash('succes', 'Bravo '. $this->getUser()->getUsername() . ' ai reusit, sa comentezi...');

        return $this->redirectToRoute('grunt_article', array('page' => $response_cat, 'id' => $articleId));

        }
    }

    public function editCommentResponseAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $response = $em->getRepository('AppBundle:CommentResponse')->findOneById($id);

        $form = $this->createFormBuilder($response)
            ->add('commentresponse', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('comment_list');

        }

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('Grunt/editResponses.html.twig', [
            'responseForm' => $form->createView(),
        ]);
    }

    public function deleteCommentResponseAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $response = $em->getRepository('AppBundle:CommentResponse')->findOneById($id);
        $em->remove($response);
        $em->flush();

        return $this->redirectToRoute('comment_list');

    }


}