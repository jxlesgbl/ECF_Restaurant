<?php

namespace App\Controller;

use App\Repository\BookingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminReservationController extends AbstractController
{
    #[Route('/admin/reservation', name: 'app_admin_reservation')]
    public function index(Request $request, BookingsRepository $bookingsRepository): Response
    {

        

        return $this->render('admin/reservation/index.html.twig', [
            
        ]);
    }
}
