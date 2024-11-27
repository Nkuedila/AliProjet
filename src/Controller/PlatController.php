<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PlatEntityRepository;
use App\Repository\CategoriesEntityRepository;
use Symfony\Component\HttpFoundation\Response;

class PlatController extends AbstractController
{
    public function platsByCategory(int $id, PlatEntityRepository $platRepository, CategoriesEntityRepository $categorieRepository): Response
    {
        $plats = $platRepository->findBy(['categorie' => $id, 'active' => true]);
        $category = $categorieRepository->find($id);

        return $this->render('plat/index.html.twig', [
            'plats' => $plats,
            'category' => $category,
        ]);
    }
}
