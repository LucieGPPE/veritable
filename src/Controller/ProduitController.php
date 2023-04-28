<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;

class ProduitController extends AbstractController
{
    #[Route('/produit/{id}', name: 'app_home')]
    public function product(ManagerRegistry $doctrine,int $id): Response
    {
        $productRepository = $doctrine->getRepository(Produit::class);
        $product = $productRepository->find($id);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'ProduitController','product'=>$product
        ]);
    }
}
