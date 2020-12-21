<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaiementRepository::class)
 */
class Paiement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCarte;

    /**
     * @ORM\Column(type="integer")
     */
    private $numCarte;

    /**
     * @ORM\Column(type="date")
     */
    private $expiration;

    /**
     * @ORM\Column(type="integer")
     */
    private $cvv;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="paiements")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCarte(): ?string
    {
        return $this->nomCarte;
    }

    public function setNomCarte(string $nomCarte): self
    {
        $this->nomCarte = $nomCarte;

        return $this;
    }

    public function getNumCarte(): ?int
    {
        return $this->numCarte;
    }

    public function setNumCarte(int $numCarte): self
    {
        $this->numCarte = $numCarte;

        return $this;
    }

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function setExpiration(\DateTimeInterface $expiration): self
    {
        $this->expiration = $expiration;

        return $this;
    }

    public function getCvv(): ?int
    {
        return $this->cvv;
    }

    public function setCvv(int $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
