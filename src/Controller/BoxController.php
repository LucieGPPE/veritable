<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Box;
use Doctrine\Persistence\ManagerRegistry;

class BoxController extends AbstractController
{
    #[Route('/box/{id}', name: 'app_box_id')]
    public function box(ManagerRegistry $doctrine,int $id): Response
    {
        $boxRepository = $doctrine->getRepository(Box::class);
        $box = $boxRepository->find($id);

        return $this->render('box/box.html.twig', [
            'controller_name' => 'BoxController','box'=>$box
        ]);
    }

    #[Route('/box', name: 'app_box')]
    public function allBox(ManagerRegistry $doctrine): Response
    {
        $boxRepository = $doctrine->getRepository(Box::class);
        $boxs = $boxRepository->findAll();

        return $this->render('box/allBox.html.twig', [
            'controller_name' => 'BoxController','box'=>$boxs
        ]);
    }
}
