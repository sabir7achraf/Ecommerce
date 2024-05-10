<?php

namespace App\Controller;

use App\Entity\Ordres;
use App\Repository\OrdresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrdersController extends AbstractController
{
    #[Route('/profile/AfficherOrdres/', name: 'app_ordres_affichage')]
    public function afficheOrders():Response
    {
        $user=$this->getUser();
        return $this->render('panier_controle/orders.html.twig', ['user'=>$user]);
    }
#[Route('/profile/deletteOrdres/{id?0}', name: 'app_ordres_delete')]
public function deleteOrders($id,OrdresRepository $repository,EntityManagerInterface $entityManager,Ordres $orders):Response{
        $entityManager->remove($orders);
    $entityManager->flush();
    return $this->redirectToRoute('order.reference');
}
#[Route('/admin/controleOrdres/', name: 'app_ordres_admin_affichage')]
public function controleOrders(OrdresRepository $repository,EntityManagerInterface $entityManager):Response
{
    $ORDRES=$repository->findByExampleField("Not delivred Yet");

    return $this->render('orders/index.html.twig', ['ordres'=>$ORDRES]);
}
#[Route('/admin/valideOrders/{id}', name: 'app_ordres_admin_valider')]
public  function validerOrder($id,OrdresRepository $repository,EntityManagerInterface $entityManager):Response
{
    $order=$repository->find($id);
    $order->setReference('delivred');
    $entityManager->persist($order);
    $entityManager->flush();
    return $this->redirectToRoute('app_ordres_admin_affichage');
}
}

