<?php

namespace App\Entity;

use App\Repository\ReservationLinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationLinkRepository::class)]
class ReservationLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reservation_taken')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $client_id = null;

    #[ORM\ManyToOne(inversedBy: 'booking')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation_id = null;

    #[ORM\Column]
    private ?int $number_seat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $allergen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?User
    {
        return $this->client_id;
    }

    public function setClientId(?User $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getReservationId(): ?Reservation
    {
        return $this->reservation_id;
    }

    public function setReservationId(?Reservation $reservation_id): self
    {
        $this->reservation_id = $reservation_id;

        return $this;
    }

    public function getNumberSeat(): ?int
    {
        return $this->number_seat;
    }

    public function setNumberSeat(int $number_seat): self
    {
        $this->number_seat = $number_seat;

        return $this;
    }

    public function getAllergen(): ?string
    {
        return $this->allergen;
    }

    public function setAllergen(?string $allergen): self
    {
        $this->allergen = $allergen;

        return $this;
    }
}
