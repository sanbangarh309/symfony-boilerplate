<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Payment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\UseCase\Payment\CreatePaymentUseCase;
use App\Dto\Request\Payment\CreatePaymentDto;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/payments')]
class PaymentController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private readonly CreatePaymentUseCase $createPayment,
        )
    {}

    #[Route('', name: 'payment_index', methods: ['GET'])]
    public function index(SerializerInterface $serializer): Response
    {
        $payments = $this->entityManager->getRepository(Payment::class)->findAll();
        $data = $serializer->normalize($payments, 'json');
        return new JsonResponse($data, 200);
    }

    #[Route('/new', name: 'payment_new', methods: ['GET', 'POST'])]
    public function new(#[MapRequestPayload]
    CreatePaymentDto $paymentDto,): JsonResponse
    {
        $payment = $this->createPayment->createPayment($paymentDto);

        $this->entityManager->flush();

        return new JsonResponse($payment);
    }

    #[Route('/{id}', name: 'update_payment', methods: ['PUT'])]
    #[IsGranted(UserVoter::EDIT_ANY_USER, subject: 'payment')]
    public function updatePayment(#[MapRequestPayload]
    CreatePaymentDto $paymentDto, Payment $payment): JsonResponse
    {
        $payment = $this->createPayment->updatePayment($payment, $paymentDto);

        $this->entityManager->flush();

        return new JsonResponse([
            'id' => $payment->getId(),
            'localization' => $payment->getLocalization(),
        ]);
    }

    #[Route('/locations/{id}', name: 'get_locations', methods: ['GET'])]
    #[IsGranted(UserVoter::EDIT_ANY_USER, subject: 'payment')]
    public function getLocations(Payment $payment): JsonResponse
    {
        $locations = $this->createPayment->fetchLocations($payment);
        return new JsonResponse([
            'locations' => $locations,
        ]);
    }

}
