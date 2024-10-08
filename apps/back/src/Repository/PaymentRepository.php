<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Payment;
use App\Dto\Request\Payment\CreatePaymentDto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function createPayment(CreatePaymentDto $paymentDto): Payment
    {
        return new Payment($paymentDto->getUserId(), $paymentDto->getAmount(), $paymentDto->getLabel(), $paymentDto->getLatitude(), $paymentDto->getLongitude(), $paymentDto->getLocalization());
    }

}
