<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\ManyToOne(inversedBy: 'abonnements')]
    private ?Duree $duree = null;

    #[ORM\ManyToOne(inversedBy: 'abonnements')]
    private ?TypeAbonnement $type_abonnement = null;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'abonnements')]
    private Collection $box;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'box')]
    private Collection $abonnements;

    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'abonnement')]
    private Collection $commandes;

    public function __construct()
    {
        $this->box = new ArrayCollection();
        $this->abonnements = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDuree(): ?Duree
    {
        return $this->duree;
    }

    public function setDuree(?Duree $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getTypeAbonnement(): ?TypeAbonnement
    {
        return $this->type_abonnement;
    }

    public function setTypeAbonnement(?TypeAbonnement $type_abonnement): self
    {
        $this->type_abonnement = $type_abonnement;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getBox(): Collection
    {
        return $this->box;
    }

    public function addBox(self $box): self
    {
        if (!$this->box->contains($box)) {
            $this->box->add($box);
        }

        return $this;
    }

    public function removeBox(self $box): self
    {
        $this->box->removeElement($box);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(self $abonnement): self
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements->add($abonnement);
            $abonnement->addBox($this);
        }

        return $this;
    }

    public function removeAbonnement(self $abonnement): self
    {
        if ($this->abonnements->removeElement($abonnement)) {
            $abonnement->removeBox($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->addAbonnement($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeAbonnement($this);
        }

        return $this;
    }
}
