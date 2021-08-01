<?php

namespace App\Entity;

use App\Repository\TrenerzyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrenerzyRepository::class)
 */
class Trenerzy
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
    private $trener;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uprawnienia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opis;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $zatrudniony;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $zwolniony;

    /**
     * @ORM\Column(type="datetime")
     */
    private $utworzony;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modyfikacja;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="trener")
     */
    private $team;

    /**
     * @@var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="trenerzy")
     */
    private $owner;

    public function __construct()
    {
        $this->team = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrener(): ?string
    {
        return $this->trener;
    }

    public function setTrener(string $trener): self
    {
        $this->trener = $trener;

        return $this;
    }

    public function __toString()
    {
        return $this->trener;
    }

    public function getUprawnienia(): ?string
    {
        return $this->uprawnienia;
    }

    public function setUprawnienia(?string $uprawnienia): self
    {
        $this->uprawnienia = $uprawnienia;

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

    public function getZatrudniony(): ?\DateTimeInterface
    {
        return $this->zatrudniony;
    }

    public function setZatrudniony(\DateTimeInterface $zatrudniony): self
    {
        $this->zatrudniony = $zatrudniony;

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

    public function getZwolniony(): ?\DateTimeInterface
    {
        return $this->zwolniony;
    }

    public function setZwolniony(?\DateTimeInterface $zwolniony): self
    {
        $this->zwolniony = $zwolniony;

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeam(): Collection
    {
        return $this->team;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->team->contains($team)) {
            $this->team[] = $team;
            $team->setTrener($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->team->contains($team)) {
            $this->team->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getTrener() === $this) {
                $team->setTrener(null);
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
