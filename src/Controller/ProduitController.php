<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_product')]
    public function product(ManagerRegistry $doctrine,Request $request): Response
    {
        
        $categoriesRepository = $doctrine->getRepository(Categorie::class);
        $categories = $categoriesRepository->findAll();

        
        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        $total = 0;

        foreach ($cart as $item) {
            $prix = $item['price'];
            $total += $prix * $item['quantity'];
        }

        return $this->render('product/allProduct.html.twig', [
            'controller_name' => 'ProduitController','categories'=>$categories,'cart'=>$cart,'total'=>$total
        ]);
    }
    #[Route('/produit/{id}', name: 'app_product_id')]
    public function productById(ManagerRegistry $doctrine,int $id,Request $request): Response
    {
        $productRepository = $doctrine->getRepository(Produit::class);
        $product = $productRepository->find($id);

        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);
   
        $total = 0;

        foreach ($cart as $item) {
            $prix = $item['price'];
            $total += $prix * $item['quantity'];
        }
        return $this->render('product/product.html.twig', [
            'controller_name' => 'ProduitController','product'=>$product,'cart'=>$cart,'total'=>$total
        ]);
    }

    #[Route('/addProduct', name: 'app_add_product_id')]
    public function addToCart(Request $request)
{   
    // Récupérez les détails du produit à partir de la requête
    $quantite = $request->request->get('qts');
    $idProduct = $request->request->get('id_product');
    $libelleProduct = $request->request->get('libelle_product');
    $price = $request->request->get('price');

    // // Récupérez le panier existant ou initialisez un nouveau panier
     $cart = $request->cookies->get('cart', '{}');
     $cart = json_decode($cart, true);

     $existingProduct = false;
     foreach ($cart as $key => $item) {
         if ($item['id'] === $idProduct) {
             $existingProduct = true;
             $cart[$key]['quantity'] += $quantite;
             break;
         }
     }

     if (!$existingProduct) {
         $cart[] = ['id' => $idProduct, 'libelle' => $libelleProduct, 'quantity' => $quantite, 'type'=>'produit', 'price'=>$price];
     }

    
 
    // // Mettez à jour le cookie du panier
     $response = new Response();
     $response->headers->setCookie(new Cookie('cart', json_encode($cart)));


     $response = $this->redirectToRoute('app_product_id', ['id' => $idProduct]);
     $response->headers->setCookie(new Cookie('cart', json_encode($cart)));
 
     return $response;
}

    
}
