<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $nom = null;

    #[ORM\Column(length: 40)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    #[ORM\Column(length: 40)]
    private ?string $role = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $num_tel = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: Article::class)]
    private Collection $articles;

    #[ORM\OneToOne(mappedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?Client $client = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_naissance = null;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): self
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->num_tel;
    }

    public function setNumTel(?string $num_tel): self
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setUtilisateur($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUtilisateur() === $this) {
                $article->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        // unset the owning side of the relation if necessary
        if ($client === null && $this->client !== null) {
            $this->client->setUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($client !== null && $client->getUtilisateur() !== $this) {
            $client->setUtilisateur($this);
        }

        $this->client = $client;

        return $this;
    }

    public function __toString() {
        return $this->nom;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getPassword(): ?string
    {
        // Retournez le mot de passe haché de l'utilisateur
        return $this->mot_de_passe;
    }

    public function getSalt(): ?string
    {
        // Vous pouvez laisser cette méthode vide si vous utilisez l'encodeur de mot de passe recommandé par Symfony (bcrypt, argon2i, etc.)
        return null;
    }

    public function eraseCredentials()
    {
        // Vous pouvez laisser cette méthode vide si vous n'avez pas besoin d'effacer les informations sensibles de l'utilisateur
    }
}
