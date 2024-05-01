<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Users;
use App\Form\ProductType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class AdminControleController extends AbstractController
{
    #[Route('/admin/controle', name: 'app_admin_controle')]
    public function index(ManagerRegistry $doctrine): Response
    {
$repository = $doctrine->getRepository(Product::class);
$donnees = $repository->findAll();
        return $this->render('admin_controle/index.html.twig', [
            'donnees' => $donnees,
        ]);
    }

    #[Route('/edit/product/{id?0}', name: 'edit_product')]
    public function addProduct(Product $product= null ,ManagerRegistry $doctrine ,Request $request): Response
    {
       if(!$product){
           $product = new Product();
       }
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $manager = $doctrine->getManager();
            $manager->persist($product);
            $manager->flush();
            $this->addFlash($product->nameProduct, "a été ajoute avec succes");
            return  $this->redirectToRoute('app_admin_controle');
        }
        return $this->render('admin_controle/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
