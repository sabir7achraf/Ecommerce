<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PanierControleController extends AbstractController
{
    #[Route('/panier/controle', name: 'app_panier_controle')]
    public function index(): Response
    {
        return $this->render('panier_controle/index.html.twig', [
            'controller_name' => 'PanierControleController',
        ]);
    }
}
