<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function product(ManagerRegistry $doctrine): Response
    {
        $categoriesRepository = $doctrine->getRepository(Categorie::class);
        $categories = $categoriesRepository->findAll();

        return $this->render('product/allProduct.html.twig', [
            'controller_name' => 'ProduitController','categories'=>$categories
        ]);
    }
    #[Route('/produit/{id}', name: 'app_produit_id')]
    public function productById(ManagerRegistry $doctrine,int $id): Response
    {
        $productRepository = $doctrine->getRepository(Produit::class);
        $product = $productRepository->find($id);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'ProduitController','product'=>$product
        ]);
    }

    
}
