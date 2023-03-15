<?php

namespace App\Controller;

use App\Entity\Bookings;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/book-table", name="book_table")
     */
    public function bookTable(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Get the form for booking a table
        $form = $this->createForm(BookingType::class);

        // Handle the form submission
        $form->handleRequest($request);

        // Create a new booking entity
        $booking = new Bookings();


        if ($form->isSubmitted() && $form->isValid()) {
            // Get the data from the form
            $bookingData = $form->getData();

            $booking->setCustomerName($bookingData['customerName']);
            $booking->setEmail($bookingData['email']);
            $booking->setPhoneNumber($bookingData['phoneNumber']);
            $booking->setNumberOfPeople($bookingData['numberOfPeople']);
            $booking->setDate($bookingData['bookingDate']);
            $booking->setTime($bookingData['bookingTime']);

            // Save the booking to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            // Send a confirmation email to the customer
            // (You'll need to implement this yourself)

            // Redirect to a confirmation page
            return $this->redirectToRoute('booking_confirmation');
        }

        // Render the booking form
        return $this->render('bookings/book-table.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/booking-confirmation", name="booking_confirmation")
     */
    public function bookingConfirmation(): Response
    {
        // Render the confirmation page
        return $this->render('bookings/confirmation.html.twig');
    }
}
