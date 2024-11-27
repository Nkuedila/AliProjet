<?php

namespace App\Entity;

use App\Repository\PlatEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatEntityRepository::class)]
class PlatEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'platEntities')]
    private ?CategoriesEntity $categorie = null;

    /**
     * @var Collection<int, CommandeEntity>
     */
    #[ORM\OneToMany(targetEntity: CommandeEntity::class, mappedBy: 'idplat')]
    private Collection $commandeEntities;

    public function __construct()
    {
        $this->commandeEntities = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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

    public function getCategorie(): ?CategoriesEntity
    {
        return $this->categorie;
    }

    public function setCategorie(?CategoriesEntity $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, CommandeEntity>
     */
    public function getCommandeEntities(): Collection
    {
        return $this->commandeEntities;
    }

    public function addCommandeEntity(CommandeEntity $commandeEntity): static
    {
        if (!$this->commandeEntities->contains($commandeEntity)) {
            $this->commandeEntities->add($commandeEntity);
            $commandeEntity->setIdplat($this);
        }

        return $this;
    }

    public function removeCommandeEntity(CommandeEntity $commandeEntity): static
    {
        if ($this->commandeEntities->removeElement($commandeEntity)) {
            // set the owning side to null (unless already changed)
            if ($commandeEntity->getIdplat() === $this) {
                $commandeEntity->setIdplat(null);
            }
        }

        return $this;
    }
}
