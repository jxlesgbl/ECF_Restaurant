<?php

namespace App\Controller;

use App\Entity\Bookings;
use App\Form\BookingType;
use App\Repository\BookingsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isNull;

#[Route('/booking')]
class BookingController extends AbstractController
{
    #[Route("/add", name:"front_booking_add")]
    public function add(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $booking = new Bookings();
        $booking->setUserId($this->getUser());
        // Get the form for booking a table
        $form = $this->createForm(BookingType::class, $booking);

        // Handle the form submission
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            // Save the booking to the database
            $entityManager = $managerRegistry->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            // Send a confirmation email to the customer
            // (do it later)

            // Redirect to a confirmation page
            return $this->redirectToRoute('front_booking_confirm', [
                "bookingId" => $booking->getId()
            ]);
        }

        // Render the booking form
        return $this->render('bookings/add.html.twig', [
            'bookings' => $booking,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/confirm/{bookingId}", name:"front_booking_confirm")]
    public function bookingConfirmation(Request $request, BookingsRepository $bookingsRepository, int $bookingId): Response
    {
        $booking = $bookingsRepository->findOneBy(['id' => $bookingId]);
        if(isNull($booking)){
            new Exception("No booking found by this id", 404);
        }
        // Render the confirmation page
        return $this->render('bookings/confirmation.html.twig', ['booking' => $booking]);
    }
}
