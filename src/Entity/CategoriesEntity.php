<?php

namespace App\Entity;

use App\Repository\CategoriesEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesEntityRepository::class)]
class CategoriesEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $active = null;

    /**
     * @var Collection<int, PlatEntity>
     */
    #[ORM\OneToMany(targetEntity: PlatEntity::class, mappedBy: 'categorie')]
    private Collection $platEntities;

    public function __construct()
    {
        $this->platEntities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, PlatEntity>
     */
    public function getPlatEntities(): Collection
    {
        return $this->platEntities;
    }

    public function addPlatEntity(PlatEntity $platEntity): static
    {
        if (!$this->platEntities->contains($platEntity)) {
            $this->platEntities->add($platEntity);
            $platEntity->setCategorie($this);
        }

        return $this;
    }

    public function removePlatEntity(PlatEntity $platEntity): static
    {
        if ($this->platEntities->removeElement($platEntity)) {
            // set the owning side to null (unless already changed)
            if ($platEntity->getCategorie() === $this) {
                $platEntity->setCategorie(null);
            }
        }

        return $this;
    }
}
