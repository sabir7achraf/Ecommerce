<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Users;
use App\Form\ProductType;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Util\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminControleController extends AbstractController
{
    #[Route('/admin/controle/', name: 'app_admin_controle')]
    public function index(ManagerRegistry $doctrine): Response
    {
$repository = $doctrine->getRepository(Product::class);
$donnees = $repository->findAll();
        return $this->render('admin_controle/index.html.twig', [
            'donnees' => $donnees,
        ]);
    }

    #[Route('/edit/product/{id?0}', name: 'edit_product')]
    public function addProduct(Product $product= null ,ManagerRegistry $doctrine ,Request $request ,SluggerInterface $slugger): Response
    {
       if(!$product){
           $product = new Product();
       }
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $manager = $doctrine->getManager();
            $imageFile = $form->get('photo')->getData();
            $imageFile2 = $form->get('photo2')->getData();
            $imageFile3 = $form->get('photo3')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
                $productDirectory='product_directory';
                // Move the file to the directory where brochures are stored
                try {
                    $imageFile->move($this->getParameter('product_directory'), $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setImage($newFilename);
            }
            if ($imageFile2) {
                $originalFilename = pathinfo($imageFile2->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile2->guessExtension();
                $productDirectory='product_directory';
                // Move the file to the directory where brochures are stored
                try {
                    $imageFile2->move($this->getParameter('product_directory'), $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setImage2($newFilename);
            }
            if ($imageFile3) {
                $originalFilename = pathinfo($imageFile3->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile3->guessExtension();
                $productDirectory='product_directory';
                // Move the file to the directory where brochures are stored
                try {
                    $imageFile3->move($this->getParameter('product_directory'), $newFilename);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $product->setImage3($newFilename);
            }
            $manager->persist($product);
            $manager->flush();
            $this->addFlash($product->nameProduct, "a été ajoute avec succes");
            return  $this->redirectToRoute('app_admin_controle');
        }
        return $this->render('admin_controle/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit/delete/{id?0}', name:'delete_product', methods: ['POST'])]
        function deleteProduct(Product $product , EntityManagerInterface $entityManager,$id){
        $entityManager->remove($product);
        $entityManager->flush();
        return  $this->redirectToRoute('app_admin_controle');
    }
}
