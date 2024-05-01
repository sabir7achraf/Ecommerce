<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Users;
use App\Form\UserType;


class UsersContorllerController extends AbstractController
{
    #[Route('/users/log_in', name: 'log_in')]
    public function login(Request $request): Response
    {
        return $this->render('first/index.html.twig'); 
    }
    #[Route('/users/contorller/{id?0}', name: 'sign_up')]
    public function indeex(Users $users=null, Request $request, ManagerRegistry $doctrine): Response
    {
        if(!$users){
            $users = new Users();
        }
        $form = $this->createForm(UserType::class, $users);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $manager = $doctrine->getManager();
            $manager->persist($users);
            $manager->flush();
            $this->addFlash($users->name, "a été ajoute avec succes");
           return  $this->redirectToRoute('log_in');
        }
        return $this->render('users_contorller/index.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
