<?php

namespace App\Entity;

use App\Repository\SezonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SezonRepository::class)
 */
class Sezon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="datetime")
     */
    private $utworzony;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modyfikacja;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opis;

    /**
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="sezon")
     * @ORM\JoinColumn(nullable=true)
     */
    private $team;

    /**
     * @var Przwciwnik[]
     * 
     * @ORM\OneToMany(targetEntity=Przeciwnik::class, mappedBy="sezon")
     */
    private $przeciwnik;

    /**
     * @@var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sezony")
     */
    private $owner;

    public function __construct()
    {
        $this->przeciwnik = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getUtworzony(): ?\DateTimeInterface
    {
        return $this->utworzony;
    }

    public function setUtworzony(\DateTimeInterface $utworzony): self
    {
        $this->utworzony = $utworzony;

        return $this;
    }

    public function getModyfikacja(): ?\DateTimeInterface
    {
        return $this->modyfikacja;
    }

    public function setModyfikacja(\DateTimeInterface $modyfikacja): self
    {
        $this->modyfikacja = $modyfikacja;

        return $this;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(?string $opis): self
    {
        $this->opis = $opis;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    /**
     * @return Collection|Przeciwnik[]
     */
    public function getPrzeciwnik(): Collection
    {
        return $this->przeciwnik;
    }

    public function addPrzeciwnik(Przeciwnik $przeciwnik): self
    {
        if (!$this->przeciwnik->contains($przeciwnik)) {
            $this->przeciwnik[] = $przeciwnik;
            $przeciwnik->setSezon($this);
        }

        return $this;
    }

    public function removePrzeciwnik(Przeciwnik $przeciwnik): self
    {
        if ($this->przeciwnik->contains($przeciwnik)) {
            $this->przeciwnik->removeElement($przeciwnik);
            // set the owning side to null (unless already changed)
            if ($przeciwnik->getSezon() === $this) {
                $przeciwnik->setSezon(null);
            }
        }

        return $this;
    }

    /**
    * @return User
    */
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    /**
    * @param User $owner
    * 
    * @return $this
    */
    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
