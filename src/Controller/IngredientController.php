<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredient;
use Doctrine\Persistence\ManagerRegistry;

class IngredientController extends AbstractController
{
    #[Route('/ingredient/{id}', name: 'app_ingredient')]
    public function ingredient(ManagerRegistry $doctrine,int $id,Request $request): Response
    {
        $ingredientRepository = $doctrine->getRepository(Ingredient::class);
        $ingredient = $ingredientRepository->find($id);

        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        $total = 0;

        foreach ($cart as $item) {
            $prix = $item['price'];
            $total += $prix * $item['quantity'];
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'IngredientController','ingredient'=>$ingredient,'cart'=>$cart,'total'=>$total
        ]);
    }
}
