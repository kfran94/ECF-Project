<?php

namespace App\Entity;

use App\Repository\MenuLinkDishRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuLinkDishRepository::class)]
class MenuLinkDish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dish_link')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Menu $menu_id = null;

    #[ORM\ManyToOne(inversedBy: 'menu_link')]
    #[ORM\JoinColumn(nullable: false)]
    private ?dish $dish_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuId(): ?Menu
    {
        return $this->menu_id;
    }

    public function setMenuId(?Menu $menu_id): self
    {
        $this->menu_id = $menu_id;

        return $this;
    }

    public function getDishId(): ?dish
    {
        return $this->dish_id;
    }

    public function setDishId(?dish $dish_id): self
    {
        $this->dish_id = $dish_id;

        return $this;
    }
}
