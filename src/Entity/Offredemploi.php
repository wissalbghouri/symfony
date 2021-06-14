<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OffredemploiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=OffredemploiRepository::class)
 */
class Offredemploi
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
    private $titreauposte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreposte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $secteurenp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $local;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="offredemplois")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreauposte(): ?string
    {
        return $this->titreauposte;
    }

    public function setTitreauposte(string $titreauposte): self
    {
        $this->titreauposte = $titreauposte;

        return $this;
    }

    public function getNombreposte(): ?string
    {
        return $this->nombreposte;
    }

    public function setNombreposte(string $nombreposte): self
    {
        $this->nombreposte = $nombreposte;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

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

    public function getSecteurenp(): ?string
    {
        return $this->secteurenp;
    }

    public function setSecteurenp(string $secteurenp): self
    {
        $this->secteurenp = $secteurenp;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(?string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getLocal(): ?string
    {
        return $this->local;
    }

    public function setLocal(?string $local): self
    {
        $this->local = $local;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
