<?php

namespace App\Controller;

use App\Repository\GalleriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalleriesController extends AbstractController
{
    #[Route('/galleries', name: 'app_galleries')]
    public function index(GalleriesRepository $galleriesRepository): Response
    {
        $galleries = $galleriesRepository->findAll();

        return $this->render('galleries/index.html.twig', [
            "galleries" => $galleries
        ]);
    }
}
