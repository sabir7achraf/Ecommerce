<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class EcommerceController extends AbstractController
{
    #[Route('/ecommerce', name: 'app_ecommerce')]
    public function index(Request $request): Response
    {
   return $this->render('ecommerce/index.html.twig');
    }

#[Route('/ecommerce/{slug}-{id}', name: 'app_ecomm')]
public function passerDesArguments(Request $request,string $slug,int $id): Response
{
return $this->render('ecommerce/show.html.twig', ['slug'=>$slug,'id'=>$id, 'html' => '<strong>messi</strong>']);
}
}
