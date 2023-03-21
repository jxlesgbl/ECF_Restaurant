<?php

namespace App\Controller;

use Exception;
use App\Repository\BookingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isNull;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');


        return $this->render('home.html.twig');
    }

    #[Route("/reservations", name:"admin_reservations")]
    public function reservations(BookingsRepository $bookingsRepository)
    {
        $booking = $bookingsRepository->findAll();
        if(isNull($booking)){
            new Exception("No booking found by this id", 404);
        }

        return $this->render('bookings/list.html.twig', [
            'bookings' => $booking
        ]);
    }

}

