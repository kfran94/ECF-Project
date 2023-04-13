<?php

namespace App\Entity;

use App\Repository\SeatMaxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeatMaxRepository::class)]
class SeatMax
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $maxSeat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxSeat(): ?int
    {
        return $this->maxSeat;
    }

    public function setMaxSeat(int $maxSeat): self
    {
        $this->maxSeat = $maxSeat;

        return $this;
    }
}
