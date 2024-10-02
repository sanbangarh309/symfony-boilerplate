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
use App\Services\GoogleGeocodingService;

use function strval;

final class UpdateLocation
{
    private PaymentDao $paymentDao;

    private $geocodingService;

    public function __construct(PaymentDao $paymentDao, GoogleGeocodingService $geocodingService)
    {
        $this->paymentDao = $paymentDao;
        $this->geocodingService = $geocodingService;
    }

    /**
     * @throws InvalidModel
     */
    #[Mutation]
    #[Logged]
    public function updateLocation(
        #[InjectUser] User $user,
        Payment $payment,
        String $latitude,
        String $longitude
    ): Payment {

        // Address fetched from Google API
        $address = $this->geocodingService->getAddressFromLatLon((float) $latitude, (float) $longitude);
    
        // Ensure the user is set properly
        $payment->setUser($user);
    
        // Set localization and save
        $payment->setLocalization($address);
        $this->paymentDao->save($payment);
    
        return $payment;
    }
}