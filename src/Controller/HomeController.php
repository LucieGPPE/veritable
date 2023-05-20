<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function box(Request $request): Response
    {
        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController','cart'=>$cart]);
    }
}
