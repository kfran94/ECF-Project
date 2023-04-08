<?php

namespace App\Entity;

use App\Repository\ParametersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParametersRepository::class)]
class Parameters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $monday_f_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $monday_f_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $monday_s_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $monday_s_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $tuesday_f_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $tuesday_f_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $tuesday_s_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $tuesday_s_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $wednesday_f_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $wednesday_f_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $wednesday_s_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $wednesday_s_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $thursday_f_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $thursday_f_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $thursday_s_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $thursday_s_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $friday_f_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $friday_f_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $friday_s_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $friday_s_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $saturday_f_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $saturday_f_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $saturday_s_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $saturday_s_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $sunday_f_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $sunday_f_c = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $sunday_s_o = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $sunday_s_c = null;

    #[ORM\Column]
    private ?int $number_total_seat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMondayFO(): ?\DateTimeInterface
    {
        return $this->monday_f_o;
    }

    public function setMondayFO(\DateTimeInterface $monday_f_o): self
    {
        $this->monday_f_o = $monday_f_o;

        return $this;
    }

    public function getMondayFC(): ?\DateTimeInterface
    {
        return $this->monday_f_c;
    }

    public function setMondayFC(\DateTimeInterface $monday_f_c): self
    {
        $this->monday_f_c = $monday_f_c;

        return $this;
    }

    public function getMondaySO(): ?\DateTimeInterface
    {
        return $this->monday_s_o;
    }

    public function setMondaySO(\DateTimeInterface $monday_s_o): self
    {
        $this->monday_s_o = $monday_s_o;

        return $this;
    }

    public function getMondaySC(): ?\DateTimeInterface
    {
        return $this->monday_s_c;
    }

    public function setMondaySC(\DateTimeInterface $monday_s_c): self
    {
        $this->monday_s_c = $monday_s_c;

        return $this;
    }

    public function getTuesdayFO(): ?\DateTimeInterface
    {
        return $this->tuesday_f_o;
    }

    public function setTuesdayFO(\DateTimeInterface $tuesday_f_o): self
    {
        $this->tuesday_f_o = $tuesday_f_o;

        return $this;
    }

    public function getTuesdayFC(): ?\DateTimeInterface
    {
        return $this->tuesday_f_c;
    }

    public function setTuesdayFC(\DateTimeInterface $tuesday_f_c): self
    {
        $this->tuesday_f_c = $tuesday_f_c;

        return $this;
    }

    public function getTuesdaySO(): ?\DateTimeInterface
    {
        return $this->tuesday_s_o;
    }

    public function setTuesdaySO(\DateTimeInterface $tuesday_s_o): self
    {
        $this->tuesday_s_o = $tuesday_s_o;

        return $this;
    }

    public function getTuesdaySC(): ?\DateTimeInterface
    {
        return $this->tuesday_s_c;
    }

    public function setTuesdaySC(\DateTimeInterface $tuesday_s_c): self
    {
        $this->tuesday_s_c = $tuesday_s_c;

        return $this;
    }

    public function getWednesdayFO(): ?\DateTimeInterface
    {
        return $this->wednesday_f_o;
    }

    public function setWednesdayFO(\DateTimeInterface $wednesday_f_o): self
    {
        $this->wednesday_f_o = $wednesday_f_o;

        return $this;
    }

    public function getWednesdayFC(): ?\DateTimeInterface
    {
        return $this->wednesday_f_c;
    }

    public function setWednesdayFC(\DateTimeInterface $wednesday_f_c): self
    {
        $this->wednesday_f_c = $wednesday_f_c;

        return $this;
    }

    public function getWednesdaySO(): ?\DateTimeInterface
    {
        return $this->wednesday_s_o;
    }

    public function setWednesdaySO(\DateTimeInterface $wednesday_s_o): self
    {
        $this->wednesday_s_o = $wednesday_s_o;

        return $this;
    }

    public function getWednesdaySC(): ?\DateTimeInterface
    {
        return $this->wednesday_s_c;
    }

    public function setWednesdaySC(\DateTimeInterface $wednesday_s_c): self
    {
        $this->wednesday_s_c = $wednesday_s_c;

        return $this;
    }

    public function getThursdayFO(): ?\DateTimeInterface
    {
        return $this->thursday_f_o;
    }

    public function setThursdayFO(\DateTimeInterface $thursday_f_o): self
    {
        $this->thursday_f_o = $thursday_f_o;

        return $this;
    }

    public function getThursdayFC(): ?\DateTimeInterface
    {
        return $this->thursday_f_c;
    }

    public function setThursdayFC(\DateTimeInterface $thursday_f_c): self
    {
        $this->thursday_f_c = $thursday_f_c;

        return $this;
    }

    public function getThursdaySO(): ?\DateTimeInterface
    {
        return $this->thursday_s_o;
    }

    public function setThursdaySO(\DateTimeInterface $thursday_s_o): self
    {
        $this->thursday_s_o = $thursday_s_o;

        return $this;
    }

    public function getThursdaySC(): ?\DateTimeInterface
    {
        return $this->thursday_s_c;
    }

    public function setThursdaySC(\DateTimeInterface $thursday_s_c): self
    {
        $this->thursday_s_c = $thursday_s_c;

        return $this;
    }

    public function getFridayFO(): ?\DateTimeInterface
    {
        return $this->friday_f_o;
    }

    public function setFridayFO(\DateTimeInterface $friday_f_o): self
    {
        $this->friday_f_o = $friday_f_o;

        return $this;
    }

    public function getFridayFC(): ?\DateTimeInterface
    {
        return $this->friday_f_c;
    }

    public function setFridayFC(\DateTimeInterface $friday_f_c): self
    {
        $this->friday_f_c = $friday_f_c;

        return $this;
    }

    public function getFridaySO(): ?\DateTimeInterface
    {
        return $this->friday_s_o;
    }

    public function setFridaySO(\DateTimeInterface $friday_s_o): self
    {
        $this->friday_s_o = $friday_s_o;

        return $this;
    }

    public function getFridaySC(): ?\DateTimeInterface
    {
        return $this->friday_s_c;
    }

    public function setFridaySC(\DateTimeInterface $friday_s_c): self
    {
        $this->friday_s_c = $friday_s_c;

        return $this;
    }

    public function getSaturdayFO(): ?\DateTimeInterface
    {
        return $this->saturday_f_o;
    }

    public function setSaturdayFO(\DateTimeInterface $saturday_f_o): self
    {
        $this->saturday_f_o = $saturday_f_o;

        return $this;
    }

    public function getSaturdayFC(): ?\DateTimeInterface
    {
        return $this->saturday_f_c;
    }

    public function setSaturdayFC(\DateTimeInterface $saturday_f_c): self
    {
        $this->saturday_f_c = $saturday_f_c;

        return $this;
    }

    public function getSaturdaySO(): ?\DateTimeInterface
    {
        return $this->saturday_s_o;
    }

    public function setSaturdaySO(\DateTimeInterface $saturday_s_o): self
    {
        $this->saturday_s_o = $saturday_s_o;

        return $this;
    }

    public function getSaturdaySC(): ?\DateTimeInterface
    {
        return $this->saturday_s_c;
    }

    public function setSaturdaySC(\DateTimeInterface $saturday_s_c): self
    {
        $this->saturday_s_c = $saturday_s_c;

        return $this;
    }

    public function getSundayFO(): ?\DateTimeInterface
    {
        return $this->sunday_f_o;
    }

    public function setSundayFO(\DateTimeInterface $sunday_f_o): self
    {
        $this->sunday_f_o = $sunday_f_o;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getSundayFC(): ?\DateTimeInterface
    {
        return $this->sunday_f_c;
    }

    public function setSundayFC(\DateTimeInterface $sunday_f_c): self
    {
        $this->sunday_f_c = $sunday_f_c;

        return $this;
    }

    public function getSundaySO(): ?\DateTimeInterface
    {
        return $this->sunday_s_o;
    }

    public function setSundaySO(\DateTimeInterface $sunday_s_o): self
    {
        $this->sunday_s_o = $sunday_s_o;

        return $this;
    }

    public function getSundaySC(): ?\DateTimeInterface
    {
        return $this->sunday_s_c;
    }

    public function setSundaySC(\DateTimeInterface $sunday_s_c): self
    {
        $this->sunday_s_c = $sunday_s_c;

        return $this;
    }

    public function getNumberTotalSeat(): ?int
    {
        return $this->number_total_seat;
    }

    public function setNumberTotalSeat(int $number_total_seat): self
    {
        $this->number_total_seat = $number_total_seat;

        return $this;
    }
}
