<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMenuController extends AbstractController
{
    #[Route('/admin/menu/list', name: 'app_admin_menu_list')]
    public function list()
    {
        return $this->render('admin/menu/list.html.twig');
    }

    #[Route('/admin/menu/edit/{id}', name: 'app_admin_menu_edit')]
    public function edit()
    {
        return $this->render('admin/menu/edit.html.twig');
    }
    
    #[Route('/admin/menu/create', name: 'app_admin_menu_create')]
    public function create()
    {
        return $this->render('admin/menu/create.html.twig');
    }

    #[Route('/admin/menu/delete/{id}', name: 'app_admin_menu_delete')]
    public function delete()
    {
        return $this->render('admin/menu/delete.html.twig');
    }
}

