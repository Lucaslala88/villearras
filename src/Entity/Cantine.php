<?php

namespace App\Entity;

use App\Repository\CantineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CantineRepository::class)]
class Cantine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $nom;

    #[ORM\Column(type: 'string', length: 30)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 100)]
    private $email;

    #[ORM\Column(type: 'string', length: 100)]
    private $NomDeLecole;

    #[ORM\Column(type: 'date')]
    private $repas;

    #[ORM\Column(type: 'datetime')]
    private $dateEnvoi;
    
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

    public function getNomDeLecole(): ?string
    {
        return $this->NomDeLecole;
    }

    public function setNomDeLecole(string $NomDeLecole): self
    {
        $this->NomDeLecole = $NomDeLecole;

        return $this;
    }

    public function getRepas(): ?\DateTimeInterface
    {
        return $this->repas;
    }

    public function setRepas(\DateTimeInterface $repas): self
    {
        $this->repas = $repas;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }
}
