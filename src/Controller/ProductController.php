<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]

    public function index(Request $request,ProductRepository $repository): Response
    {
$Product=$repository-> findByExampleField(250);

return $this->render('product/index.html.twig',['product'=>$Product]);

    }
  
}
