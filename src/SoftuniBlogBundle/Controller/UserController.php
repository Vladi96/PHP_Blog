<?php

namespace SoftuniBlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SoftuniBlogBundle\Entity\user;
use SoftuniBlogBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/register", name = "user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user= new user();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $password = $this->get('security.password_encoder')
                ->encodePassword($user,$user->getPassword());

            $user->setPassword($password);

            $em= $this->getDoctrine()->getManager();
            $em ->persist($user);
            $em->flush();
            return $this->redirectToRoute("security_login");
        }

        return $this->render("user/register.html.twig", ['form'=>$form->createView()]);
    }

    /**
     * @Route("/profile",name= "user_profile")
     *
     * @return Response
     */
    public function profileGet(){
        return $this->render('user/profile.html.twig',[
            'user'=>$this
        ]);
    }
}