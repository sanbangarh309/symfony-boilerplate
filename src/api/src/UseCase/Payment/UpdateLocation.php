<?php

declare(strict_types=1);

namespace App\UseCase\Payment;

use App\Domain\Dao\PaymentDao;
use App\Domain\Enum\Locale;
use App\Domain\Model\ { Payment, User };
use App\Domain\Throwable\InvalidModel;
use TheCodingMachine\GraphQLite\Annotations\InjectUser;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;

use function strval;

final class UpdateLocation
{
    private PaymentDao $paymentDao;

    public function __construct(PaymentDao $paymentDao)
    {
        $this->paymentDao = $paymentDao;
    }

    /**
     * @throws InvalidModel
     */
    #[Mutation]
    #[Logged]
    public function updateLocation(
        Payment $payment,
        String $latitude,
        String $longitude
    ): Payment {
        $localization = $this->paymentDao->getAddressFromLatLon([
            $latitude, $longitude
        ]);
        dump($payment);
        return $payment;
        // $payment->setCreatedAt($payment->getCreatedAt()->format('Y-m-d H:i:s'));
        $payment->setLocalization($localization);
        $this->paymentDao->save($payment);
        return $payment;
    }
}