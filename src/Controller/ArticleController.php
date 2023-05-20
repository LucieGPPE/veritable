<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;

class ArticleController extends AbstractController
{
    #[Route('/article/{id}', name: 'app_article')]
    public function article(ManagerRegistry $doctrine,int $id,Request $request): Response
    {
        $articleRepository = $doctrine->getRepository(Article::class);
        $article = $articleRepository->find($id);

        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'ArticleController','article'=>$article,'cart'=>$cart
        ]);
    }
}
