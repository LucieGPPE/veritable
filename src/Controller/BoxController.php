<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Box;
use App\Entity\Duree;
use App\Entity\TypeAbonnement;
use Doctrine\Persistence\ManagerRegistry;

class BoxController extends AbstractController
{
    #[Route('/box/{id}', name: 'app_box_id')]
    public function box(ManagerRegistry $doctrine,int $id,Request $request): Response
    {
        $boxRepository = $doctrine->getRepository(Box::class);
        $box = $boxRepository->find($id);

        $dureeRepository = $doctrine->getRepository(Duree::class);
        $durees = $dureeRepository->findAll();

        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);


        return $this->render('box/box.html.twig', [
            'controller_name' => 'BoxController','box'=>$box,'cart'=>$cart,'durees'=>$durees
        ]);
    }

    #[Route('/box', name: 'app_box')]
    public function allBox(ManagerRegistry $doctrine,Request $request): Response
    {
        $boxRepository = $doctrine->getRepository(Box::class);
        $boxs = $boxRepository->findAll();

        $dureeRepository = $doctrine->getRepository(Duree::class);
        $durees = $dureeRepository->findAll();
       
        $cart = $request->cookies->get('cart', '{}');
        $cart = json_decode($cart, true);

        return $this->render('box/allBox.html.twig', [
            'controller_name' => 'BoxController','boxs'=>$boxs,'durees'=>$durees,'cart'=>$cart
        ]);
    }

    #[Route('/addBox', name: 'app_add_order_id')]
    public function addBox(ManagerRegistry $doctrine,Request $request): Response
    {
    $subscriptionType = $request->request->get('subscription-type');
    $idBox = $request->request->get('box-id');
    $boxLibelle = $request->request->get('box-libelle');

    $quantite = 1; 
    $cart = $request->cookies->get('cart', '{}');
    $cart = json_decode($cart, true);



    if($subscriptionType==="solo"){
        $existingOrder = false;
        foreach ($cart as $key => $item) {
            if ($item['type'] === 'box' && $item['id'] === $idBox) {
                $existingProduct = true;
                $cart[$key]['quantity'] += $quantite;
                break;
            }
        }
        if (!$existingOrder) {
            $cart[] = ['id' => $idBox, 'libelle' => $boxLibelle, 'quantity' => $quantite, 'type'=>'box'];
        }
    }else{
        $existingSubscription = false;
        foreach ($cart as $key => $item) {
            if ($item['type'] === 'subscription' &&$item['id'] === $idBox && $item['duree'] === $subscriptionType) {
                $existingSubscription = true;
                $cart[$key]['duree']=$subscriptionType;
                break;
            }
        }
        if (!$existingSubscription) {
            $cart[] = ['id' => $idBox, 'libelle' => $boxLibelle, 'quantity' => $quantite, 'type'=>'subscription','duree'=>$subscriptionType];
        }
    }
 
    // // Mettez à jour le cookie du panier
     $response = new Response();
     $response->headers->setCookie(new Cookie('cart', json_encode($cart)));


     $response = $this->redirectToRoute('app_box_id', ['id' => $idBox]);
     $response->headers->setCookie(new Cookie('cart', json_encode($cart)));
 
     return $response;
    }
}
