<?php

namespace App\Entity;

use App\Repository\OpeningHoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpeningHoursRepository::class)]
class OpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $opening_hours_morning = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closing_hours_morning = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $opening_hours_evening = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closing_hours_evening = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpeningHoursMorning(): ?\DateTimeInterface
    {
        return $this->opening_hours_morning;
    }

    public function setOpeningHoursMorning(?\DateTimeInterface $opening_hours_morning): self
    {
        $this->opening_hours_morning = $opening_hours_morning;

        return $this;
    }

    public function getClosingHoursMorning(): ?\DateTimeInterface
    {
        return $this->closing_hours_morning;
    }

    public function setClosingHoursMorning(?\DateTimeInterface $closing_hours_morning): self
    {
        $this->closing_hours_morning = $closing_hours_morning;

        return $this;
    }

    public function getOpeningHoursEvening(): ?\DateTimeInterface
    {
        return $this->opening_hours_evening;
    }

    public function setOpeningHoursEvening(?\DateTimeInterface $opening_hours_evening): self
    {
        $this->opening_hours_evening = $opening_hours_evening;

        return $this;
    }

    public function getClosingHoursEvening(): ?\DateTimeInterface
    {
        return $this->closing_hours_evening;
    }

    public function setClosingHoursEvening(?\DateTimeInterface $closing_hours_evening): self
    {
        $this->closing_hours_evening = $closing_hours_evening;

        return $this;
    }
}
