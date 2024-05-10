<?php

namespace App\Controller;

use App\Entity\Ordres;
use App\Repository\OrdresRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PanierControleController extends AbstractController
{
    #[Route('/panier/controle/{id}', name: 'app_panier_controle')]
    public function index(ManagerRegistry $doctrine, $id, ProductRepository $repository): Response
    {

        $product = $repository->findByExampleField($id);
        return $this->render('panier_controle/index.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/profile/ordresAjouterAubdd/{id}', name: 'app_ordres_controle')]
    public function ControllerOrdres(ProductRepository $repository, $id, ManagerRegistry $doctrine): Response
    {
        $manager = $doctrine->getManager();
        $products = $repository->findByExampleField($id);
        $order = new Ordres();
        foreach ($products as $product) {
            $order->addProduct($product);
            $order->setProductId($product);
        }
        $order->setUser($this->getUser());
        $order->setReference('Not delivred Yet');
        $manager->persist($order);
        $manager->flush();
        return $this->render('panier_controle/index.html.twig', [
            'product' => $products,
        ]);
    }
}

