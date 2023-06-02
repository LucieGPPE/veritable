<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;

class CategorieController extends AbstractController
{
    #[Route('/ingredient/{id}', name: 'app_category')]
    public function category(ManagerRegistry $doctrine,int $id,Request $request): Response
    {
        $categoryRepository = $doctrine->getRepository(Categorie::class);
        $category = $categoryRepository->find($id);
        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        $total = 0;

        foreach ($cart as $item) {
            $prix = $item['price'];
            $total += $prix * $item['quantity'];
        }
        
        return $this->render('home/index.html.twig', [
           
            'controller_name' => 'CategorieController','categorie'=>$category,'cart'=>$cart
        ]);
    }
}
