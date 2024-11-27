<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoriesEntityRepository;
use App\Repository\PlatEntityRepository;



class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(CategoriesEntityRepository $CategorieRepository, PlatEntityRepository $PlatRepository)
    {
        $categories = $CategorieRepository->findBy(['active' => true]);
        $plats = $PlatRepository->findBy(['active' => true]);

        $categories = array_slice($categories, 0, 3);

        $plats = array_slice($plats, 0, 3);



        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'categories' => $categories,
            'plats' => $plats,


        ]);
    }
}
