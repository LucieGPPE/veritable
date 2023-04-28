<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToMany(targetEntity: Abonnement::class, inversedBy: 'commandes')]
    private Collection $abonnement;

    #[ORM\ManyToMany(targetEntity: Box::class, inversedBy: 'commandes')]
    private Collection $box;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'commandes')]
    private Collection $produit;

    public function __construct()
    {
        $this->abonnement = new ArrayCollection();
        $this->box = new ArrayCollection();
        $this->produit = new ArrayCollection();
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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, Abonnement>
     */
    public function getAbonnement(): Collection
    {
        return $this->abonnement;
    }

    public function addAbonnement(Abonnement $abonnement): self
    {
        if (!$this->abonnement->contains($abonnement)) {
            $this->abonnement->add($abonnement);
        }

        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): self
    {
        $this->abonnement->removeElement($abonnement);

        return $this;
    }

    /**
     * @return Collection<int, Box>
     */
    public function getBox(): Collection
    {
        return $this->box;
    }

    public function addBox(Box $box): self
    {
        if (!$this->box->contains($box)) {
            $this->box->add($box);
        }

        return $this;
    }

    public function removeBox(Box $box): self
    {
        $this->box->removeElement($box);

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        $this->produit->removeElement($produit);

        return $this;
    }

}
