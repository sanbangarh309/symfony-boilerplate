<?php

declare(strict_types=1);

namespace App\UseCase\Payment;

use App\Dto\Request\Payment\CreatePaymentDto;
use App\Entity\Payment;
use App\Mailer\UserMailer;
use App\Repository\PaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Services\GoogleGeocodingService;

class CreatePaymentUseCase
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly PaymentRepository $paymentRepository,
        private GoogleGeocodingService $geocodingService,
    ) {
    }

    public function createPayment(CreatePaymentDto $paymentDto): Payment
    {
        $payment = $this->paymentRepository->createPayment($paymentDto);
        $this->entityManager->persist($payment);
        $this->entityManager->flush();

        return $payment;
    }

    public function updatePayment(Payment $payment, CreatePaymentDto $paymentDto): Payment
    {
        $address = $this->geocodingService->getAddressFromLatLon((float) $payment->getLatitude(), (float) $payment->getLongitude());
        $payment->setLocalization($paymentDto->getLocalization());
        $this->entityManager->persist($payment);
        $this->entityManager->flush();

        return $payment;
    }

    public function fetchLocations(Payment $payment): Array
    {
        $locations = $this->geocodingService->getLocations((float) $payment->getLatitude(), (float) $payment->getLongitude());
        
        $reformatArray = [];
        if (isset($locations['results'])) {
            foreach ($locations['results'] as $location) {
                $reformatArray[] = [
                    'name' => $location['formatted_address'],
                ];
            }
        }
        return $reformatArray;
    }

    
}
