<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PlatEntityRepository;


class TousleplatsController extends AbstractController
{
    #[Route('/tousleplats', name: 'app_tousleplats')]
    public function index(PlatEntityRepository $PlatRepository)
    {

        $plats = $PlatRepository->findBy(['active' => true]);

        return $this->render('tousleplats/index.html.twig', [
            'plats' => $plats,
        ]);
    }
}
