<?php

namespace UseCase;

use App\Dto\Request\Payment\CreatePaymentDto;
use App\Entity\Payment;
use App\UseCase\Payment\CreatePaymentUseCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreatePaymentTest extends WebTestCase
{
    public function testCreatePayment(): void
    {
        $createPayment = static::getContainer()->get(CreatePaymentUseCase::class);

        $paymentDto = new CreatePaymentDto(1, 101, 'Payment Label 101', '29.995640', '77.048767');

        $paymentTest = new Payment($paymentDto->getAmount());

        self::assertEquals($paymentTest->getAmount(), $createPayment->createUser($paymentDto)->getAmount());
    }
}
