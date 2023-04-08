<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'menu_id', targetEntity: MenuLinkDish::class)]
    private Collection $dish_link;

    public function __construct()
    {
        $this->dish_link = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, MenuLinkDish>
     */
    public function getDishLink(): Collection
    {
        return $this->dish_link;
    }

    public function addDishLink(MenuLinkDish $dishLink): self
    {
        if (!$this->dish_link->contains($dishLink)) {
            $this->dish_link->add($dishLink);
            $dishLink->setMenuId($this);
        }

        return $this;
    }

    public function removeDishLink(MenuLinkDish $dishLink): self
    {
        if ($this->dish_link->removeElement($dishLink)) {
            // set the owning side to null (unless already changed)
            if ($dishLink->getMenuId() === $this) {
                $dishLink->setMenuId(null);
            }
        }

        return $this;
    }
}
