<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *  @ApiResource
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nomEnp;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $domaineAct;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $typeEnp;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siteweb;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $numtel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motpass;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="categorie")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=AppelOffre::class, mappedBy="entreprise", orphanRemoval=true)
     */
    private $appelOffres;

    /**
     * @ORM\OneToMany(targetEntity=Offredemploi::class, mappedBy="entreprise", orphanRemoval=true)
     */
    private $offredemplois;

    /**
     * @ORM\OneToMany(targetEntity=Formation::class, mappedBy="entreprise", orphanRemoval=true)
     */
    private $formations;

    public function __construct()
    {
        $this->appelOffres = new ArrayCollection();
        $this->offredemplois = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnp(): ?string
    {
        return $this->nomEnp;
    }

    public function setNomEnp(string $nomEnp): self
    {
        $this->nomEnp = $nomEnp;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDomaineAct(): ?string
    {
        return $this->domaineAct;
    }

    public function setDomaineAct(string $domaineAct): self
    {
        $this->domaineAct = $domaineAct;

        return $this;
    }

    public function getTypeEnp(): ?string
    {
        return $this->typeEnp;
    }

    public function setTypeEnp(string $typeEnp): self
    {
        $this->typeEnp = $typeEnp;

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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(?string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    public function getNumtel(): ?string
    {
        return $this->numtel;
    }

    public function setNumtel(string $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getMotpass(): ?string
    {
        return $this->motpass;
    }

    public function setMotpass(string $motpass): self
    {
        $this->motpass = $motpass;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

        return $this;
    }



    public function eraseCredentials(){}
    public function getRoles(){
        return array('ROLE_USER');
    }
    public function getSalt(){}
    
    public function getUsername(){
        return $this->email;
    }

    public function getPassword(){
        return $this->motpass;
    }

    /**
     * @return Collection|AppelOffre[]
     */
    public function getAppelOffres(): Collection
    {
        return $this->appelOffres;
    }

    public function addAppelOffre(AppelOffre $appelOffre): self
    {
        if (!$this->appelOffres->contains($appelOffre)) {
            $this->appelOffres[] = $appelOffre;
            $appelOffre->setEntreprise($this);
        }

        return $this;
    }

    public function removeAppelOffre(AppelOffre $appelOffre): self
    {
        if ($this->appelOffres->removeElement($appelOffre)) {
            // set the owning side to null (unless already changed)
            if ($appelOffre->getEntreprise() === $this) {
                $appelOffre->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Offredemploi[]
     */
    public function getOffredemplois(): Collection
    {
        return $this->offredemplois;
    }

    public function addOffredemploi(Offredemploi $offredemploi): self
    {
        if (!$this->offredemplois->contains($offredemploi)) {
            $this->offredemplois[] = $offredemploi;
            $offredemploi->setEntreprise($this);
        }

        return $this;
    }

    public function removeOffredemploi(Offredemploi $offredemploi): self
    {
        if ($this->offredemplois->removeElement($offredemploi)) {
            // set the owning side to null (unless already changed)
            if ($offredemploi->getEntreprise() === $this) {
                $offredemploi->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setEntreprise($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getEntreprise() === $this) {
                $formation->setEntreprise(null);
            }
        }

        return $this;
    }

}
