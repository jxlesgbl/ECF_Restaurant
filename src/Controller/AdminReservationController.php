<?php

namespace App\Controller;

use App\Repository\BookingsRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use function PHPUnit\Framework\isNull;

class AdminReservationController extends AbstractController
{
    #[Route('/admin/reservation', name: 'app_admin_reservation')]
    public function index(Request $request, BookingsRepository $bookingsRepository): Response
    {

        $reservations = $bookingsRepository->findAll();
        if(isNull($reservations)){
            new Exception("No booking found by this id", 404);
        }

        return $this->render('admin/reservation/index.html.twig', [
            
        ]);
    }
}
