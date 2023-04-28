<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredient;
use Doctrine\Persistence\ManagerRegistry;

class IngredientController extends AbstractController
{
    #[Route('/ingredient/{id}', name: 'app_home')]
    public function ingredient(ManagerRegistry $doctrine,int $id): Response
    {
        $ingredientRepository = $doctrine->getRepository(Ingredient::class);
        $ingredient = $ingredientRepository->find($id);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'IngredientController','ingredient'=>$ingredient
        ]);
    }
}
