<?php

declare(strict_types=1);

namespace App\Dto\Request\Payment;

use Symfony\Component\Validator\Constraints as Assert;

class CreatePaymentDto
{
    #[Assert\NotBlank]
    #[Assert\Type("integer")]
    public int $userId;

    #[Assert\NotBlank]
    #[Assert\Type("float")]
    public float $amount;

    #[Assert\NotBlank]
    #[Assert\Type("string")]
    public string $label;

    #[Assert\NotBlank]
    #[Assert\Type("string")]
    public string $latitude;

    #[Assert\NotBlank]
    #[Assert\Type("string")]
    public string $longitude;

    #[Assert\Type("string")]
    public ?string $localization;

    #[Assert\Type("string")]
    public ?string $createdAt;

    /**
     * Constructor to initialize optional fields
     */
    public function __construct(
        int $userId,
        float $amount,
        string $label,
        string $latitude,
        string $longitude,
        ?string $localization = null,
        ?string $createdAt = null
    ) {
        $this->userId = $userId;
        $this->amount = $amount;
        $this->label = $label;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->localization = $localization;
        $this->createdAt = $createdAt;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }



    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getLocalization(): string
    {
        return $this->localization;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}