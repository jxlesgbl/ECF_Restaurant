<?php

namespace App\Form;

use App\Entity\Bookings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Your first name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Your last name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email address',
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Phone number',
            ])
            ->add('numberOfPeople', IntegerType::class, [
                'label' => 'Number of people',
            ])
            ->add('date', DateType::class, [
                'label' => 'Booking date',
                'widget' => 'single_text',
            ])
            ->add('time', TimeType::class, [
                'label' => 'Booking time',
                'widget' => 'single_text',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Book now',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bookings::class,
        ]);
    }
}
