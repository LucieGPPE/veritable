<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'app_article')]
    public function article(ManagerRegistry $doctrine,int $id): Response
    {
        $articleRepository = $doctrine->getRepository(Article::class);
        $article = $articleRepository->find($id);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'ArticleController','article'=>$article
        ]);
    }
}
