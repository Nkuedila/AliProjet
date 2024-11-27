<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesEntityRepository;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'category_index')]
    public function index(CategoriesEntityRepository $categorieRepository)
    {
        $categories = $categorieRepository->findBy(['active' => true]);

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
