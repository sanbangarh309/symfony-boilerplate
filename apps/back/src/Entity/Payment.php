<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PaymentRepository;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\Table(name: "payments")]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]  // Automatically generate the ID
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct(
        #[ORM\Column(type: "bigint", nullable: false)]
        private int $user_id,
        #[ORM\Column(type: "float")]
        private float $amount,
        #[ORM\Column(type: "string", length: 50, nullable: true)]
        private ?string $label = null,
        #[ORM\Column(type: "string", length: 50, nullable: true)]
        private ?string $latitude = null,
        #[ORM\Column(type: "string", length: 50, nullable: true)]
        private ?string $longitude = null,
        #[ORM\Column(type: "text", nullable: true)]
        private ?string $localization = null
    ) {
        $this->user_id = $user_id;
        $this->amount = $amount;
        $this->label = $label;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->localization = $localization;
        $this->createdAt = new \DateTimeImmutable();
    }

     // Add lifecycle callback to automatically update updatedAt
     #[ORM\PreUpdate]
     public function updateTimestamp(): void
     {
         $this->updatedAt = new \DateTimeImmutable();
     }

    // Add your getters and setters here

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function getLocalization(): ?string
    {
        return $this->localization;
    }

    public function setLocalization(?string $localization): self
    {
        $this->localization = $localization;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
