<?php

namespace App\Controller;

use App\Repository\MenusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, MenusRepository $menusRepository): Response
    {
        $menus = $menusRepository->findAll();

        return $this->render('home.html.twig', [
            'menus' => $menus
        ]);
    }
}
