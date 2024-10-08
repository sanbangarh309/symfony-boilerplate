<?php

namespace App\Serializer;

use App\Dto\Request\Payment\CreatePaymentDto;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Security\Core\Security;

class CreatePaymentDtoDenormalizer implements DenormalizerInterface
{
    public function __construct(private Security $security)
    {}

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === CreatePaymentDto::class;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $userId = $this->security->getUser()?->getUserId();
        return new CreatePaymentDto(
            (int) $userId,
            (float) $data['amount'],
            $data['label'] ?? null,
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $data['localization'] ?? null
        );
    }
}
