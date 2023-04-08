<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DishRepository::class)]
class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\OneToMany(mappedBy: 'dish_id', targetEntity: MenuLinkDish::class)]
    private Collection $menu_link;

    public function __construct()
    {
        $this->menu_link = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, MenuLinkDish>
     */
    public function getMenuLink(): Collection
    {
        return $this->menu_link;
    }

    public function addMenuLink(MenuLinkDish $menuLink): self
    {
        if (!$this->menu_link->contains($menuLink)) {
            $this->menu_link->add($menuLink);
            $menuLink->setDishId($this);
        }

        return $this;
    }

    public function removeMenuLink(MenuLinkDish $menuLink): self
    {
        if ($this->menu_link->removeElement($menuLink)) {
            // set the owning side to null (unless already changed)
            if ($menuLink->getDishId() === $this) {
                $menuLink->setDishId(null);
            }
        }

        return $this;
    }
}
