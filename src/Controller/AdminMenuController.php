<?php

namespace App\Controller;

use App\Entity\Menus;
use App\Form\MenuType;
use App\Repository\MenusRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


use function PHPUnit\Framework\isNull;

class AdminMenuController extends AbstractController
{
    #[Route('/admin/menu/list', name: 'app_admin_menu_list')]
    public function list(Request $request, MenusRepository $menusRepository)
    {
        $menus = $menusRepository->findAll();
        if(isNull($menus)){
            new Exception("No menus found.", 404);
        }
        return $this->render('admin/menu/list.html.twig', [
            'menus' => $menus
        ]);
    }

    #[Route('/admin/menu/edit/{id}', name: 'app_admin_menu_edit')]
    public function edit(Request $request, MenusRepository $menusRepository)
    {   
        $menu = $menusRepository->getId($this->get);

        return $this->render('admin/menu/edit.html.twig', [
            'menus' => $menus,
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/admin/menu/create', name: 'app_admin_menu_create')]
    public function create(Request $request, ManagerRegistry $managerRegistry, SluggerInterface $slugger): Response
    {
        $menus = new Menus();

        // Get the form for creating a menu
        $form = $this->createForm(MenuType::class, $menus);

        // Handle the form submission
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('imageFile')->getData();

            if($imageFile){
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try{
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    new Exception('could not upload file', 404);
                }

                $menus->setImageName($newFilename);
            }

            // Save the menu to the database
            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($menus);
            $entityManager->flush();

            // Redirect to listing page
            return $this->redirectToRoute('app_admin_menu_list');
        }

        return $this->render('admin/menu/create.html.twig', [
            'menus' => $menus,
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/menu/delete/{id}', name: 'app_admin_menu_delete')]
    public function delete()
    {
        return $this->render('admin/menu/delete.html.twig');
    }
}

