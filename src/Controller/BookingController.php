<?php

namespace App\Controller;

use App\Entity\Bookings;
use App\Form\BookingType;
use App\Repository\BookingsRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        $start_time = new DateTime('11:30');
        $end_time = new DateTime('14:00');
        $time_slots = array();

        for ($time = $start_time; $time <= $end_time; $time->modify('+15 minutes')) {
            $time_slots[] = $time->format('H:i');
        }

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
            'time_slot' => $time_slots,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/check_availability", name:"check_availability", methods:["POST"])]
    public function checkAvailability(Request $request)
    {
        $time_slot = $request->request->get('time_slot');

        // TODO: Query the database to check availability for $time_slot
        //COUNT bookings WHERE date = now AND time = now

        $availability = 50; // Maximum available being 50 people

        return new JsonResponse(array('availability' => $availability));
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
