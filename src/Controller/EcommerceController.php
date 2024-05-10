<?php

namespace App\Controller;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class EcommerceController extends AbstractController
{
    #[Route('/ecommerce', name: 'app_ecommerce')]
    public function index(Request $request,ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Product::class);
        $donnees = $repository->findAll();
        $user=$this->getUser();

   return $this->render('ecommerce/index.html.twig', [
       'donnees' => $donnees,'user'=>$user
   ]);
    }


}

