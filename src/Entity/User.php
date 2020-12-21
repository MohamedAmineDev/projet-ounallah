<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string",nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $matriculeFiscale;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $registreDesCommerces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\OneToMany(targetEntity=Sondage::class, mappedBy="enqueteur")
     */
    private $sondages;

    /**
     * @ORM\ManyToMany(targetEntity=Conversation::class, mappedBy="users")
     */
    private $conversations;

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="user")
     */
    private $reponses;

    /**
     * @ORM\OneToMany(targetEntity=Paiement::class, mappedBy="user")
     */
    private $paiements;

    public function __construct()
    {
        $this->sondages = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->reponses = new ArrayCollection();
        $this->paiements = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(?int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMatriculeFiscale()
    {
        return $this->matriculeFiscale;
    }

    public function setMatriculeFiscale($matriculeFiscale): self
    {
        $this->matriculeFiscale = $matriculeFiscale;

        return $this;
    }

    public function getRegistreDesCommerces()
    {
        return $this->registreDesCommerces;
    }

    public function setRegistreDesCommerces($registreDesCommerces): self
    {
        $this->registreDesCommerces = $registreDesCommerces;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getGenre(): ?bool
    {
        return $this->genre;
    }

    public function setGenre(?bool $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCin(): ?int
    {
        return $this->cin;
    }

    public function setCin(?int $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection|Sondage[]
     */
    public function getSondages(): Collection
    {
        return $this->sondages;
    }

    public function addSondage(Sondage $sondage): self
    {
        if (!$this->sondages->contains($sondage)) {
            $this->sondages[] = $sondage;
            $sondage->setEnqueteur($this);
        }

        return $this;
    }

    public function removeSondage(Sondage $sondage): self
    {
        if ($this->sondages->removeElement($sondage)) {
            // set the owning side to null (unless already changed)
            if ($sondage->getEnqueteur() === $this) {
                $sondage->setEnqueteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations[] = $conversation;
            $conversation->addUser($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            $conversation->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setUser($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getUser() === $this) {
                $reponse->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements[] = $paiement;
            $paiement->setUser($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getUser() === $this) {
                $paiement->setUser(null);
            }
        }

        return $this;
    }
}
