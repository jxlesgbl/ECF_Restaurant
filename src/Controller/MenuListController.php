<?php

namespace App\Controller;

use App\Entity\Menus;
use App\Repository\MenusRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use function PHPUnit\Framework\isNull;

class MenuListController extends AbstractController
{
    #[Route('/list', name: 'app_menu_list')]
    public function list(MenusRepository $menusRepository)
    {
        $menus = $menusRepository->findAll();
        if(isNull($menus)){
            new Exception("No menus found.", 404);
        }
        return $this->render('menu/list.html.twig', [
            'menus' => $menus
        ]);
    }
}