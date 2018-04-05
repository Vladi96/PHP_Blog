<?php

namespace SoftuniBlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SoftuniBlogBundle\Entity\Article;
use SoftuniBlogBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    /**
     * @param Request $request
     * @Route("article/create", name="article_create")
     * @Security("is_granted('IIS_AUTHENTICATED_FULLY')")
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function create(Request $request){
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $article ->setAuthor($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('blog_index');

        }
        return $this->render('article/create.html.twig',['form'=>$form->createView()]);

    }

    /**
     * @Route("/article/details/{id}", name="article_details")
     * @param $id
     * @return Response
     *
     */
    public function detailsGet($id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

      return $this-> render('article/details.thml.twig',[
        'article'=>$article
        ]);
    }
}
