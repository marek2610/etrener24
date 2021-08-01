<?php

namespace App\Entity;

use App\Repository\KategoriaWiekowaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=KategoriaWiekowaRepository::class)
 */
class KategoriaWiekowa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Pole nie może być puste.")
     */
    private $nazwaPzpn;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Pole nie może być puste.")
     */
    private $grupaWiekowa;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Pole nie może być puste.")
     */
    private $nazwaUefa;

    /**
     * @ORM\OneToMany(targetEntity=Team::class, mappedBy="grupaWiekowa")
     */
    private $team;

    public function __construct()
    {
        $this->team = new ArrayCollection();
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

    public function getGrupa(): ?string
    {
        return $this->grupa;
    }

    public function setGrupa(string $grupa): self
    {
        $this->grupa = $grupa;

        return $this;
    }

    public function getNazwaPzpn(): ?string
    {
        return $this->nazwaPzpn;
    }

    public function setNazwaPzpn(string $nazwaPzpn): self
    {
        $this->nazwaPzpn = $nazwaPzpn;

        return $this;
    }

    public function getGrupaWiekowa(): ?string
    {
        return $this->grupaWiekowa;
    }

    public function setGrupaWiekowa(string $grupaWiekowa): self
    {
        $this->grupaWiekowa = $grupaWiekowa;

        return $this;
    }

    public function __toString()
    {
        return $this->grupaWiekowa;
    }

    public function getNazwaUefa(): ?string
    {
        return $this->nazwaUefa;
    }

    public function setNazwaUefa(string $nazwaUefa): self
    {
        $this->nazwaUefa = $nazwaUefa;

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
            $team->setGrupaWiekowa($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->team->contains($team)) {
            $this->team->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getGrupaWiekowa() === $this) {
                $team->setGrupaWiekowa(null);
            }
        }

        return $this;
    }

}
