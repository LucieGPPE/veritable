<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function box(Request $request): Response
    {
        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        $total = 0;

        foreach ($cart as $item) {
            $prix = $item['price'];
            $total += $prix * $item['quantity'];
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController','cart'=>$cart,'total'=>$total]);
    }

    #[Route('/decrease-quantity/{itemId}', name: 'decrease_quantity')]
    public function decreaseQuantity($itemId,Request $request,RequestStack $requestStack)
    {
        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        $foundIndex = null;
        foreach ($cart as $index => $item) {
            if ($item['id'] === $itemId) {
                $foundIndex = $index;
                break;
            }
        }

        // Vérifie si l'objet a été trouvé dans le panier
        if ($foundIndex !== null) {
            // Diminue la quantité de l'objet
            $cart[$foundIndex]['quantity'] -= 1;

            // Vérifie si la quantité est inférieure ou égale à zéro
            if ($cart[$foundIndex]['quantity'] <= 0) {
                // Supprime l'objet du panier
                array_splice($cart, $foundIndex, 1);
            }

            // Met à jour le cookie avec le panier modifié
            $response = new Response();
            $response->headers->setCookie(new Cookie('cart', json_encode($cart)));
            $response->send();
        }

        $referer = $requestStack->getCurrentRequest()->headers->get('referer');
        $redirectUrl = $referer ?: $this->generateUrl('app_home');

        return $this->redirect($redirectUrl);
    }
}
