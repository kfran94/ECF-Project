<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $service = null;

    #[ORM\OneToMany(mappedBy: 'reservation_id', targetEntity: ReservationLink::class)]
    private Collection $booking;

    public function __construct()
    {
        $this->booking = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getService(): ?int
    {
        return $this->service;
    }

    public function setService(int $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Collection<int, ReservationLink>
     */
    public function getBooking(): Collection
    {
        return $this->booking;
    }

    public function addBooking(ReservationLink $booking): self
    {
        if (!$this->booking->contains($booking)) {
            $this->booking->add($booking);
            $booking->setReservationId($this);
        }

        return $this;
    }

    public function removeBooking(ReservationLink $booking): self
    {
        if ($this->booking->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getReservationId() === $this) {
                $booking->setReservationId(null);
            }
        }

        return $this;
    }
}
