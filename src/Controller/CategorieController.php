<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use Doctrine\Persistence\ManagerRegistry;

class CategorieController extends AbstractController
{
    #[Route('/ingredient/{id}', name: 'app_home')]
    public function category(ManagerRegistry $doctrine,int $id): Response
    {
        $categoryRepository = $doctrine->getRepository(Categorie::class);
        $category = $categoryRepository->find($id);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'CategorieController','categorie'=>$category
        ]);
    }
}
