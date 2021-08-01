<?php

namespace App\Entity;

use App\Repository\MeczeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeczeRepository::class)
 */
class Mecze
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $wynikHome;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $wynikAway;

    /**
     * @ORM\Column(type="datetime")
     */
    private $utworzony;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modyfikacja;

    /**
     * @ORM\ManyToOne(targetEntity=Przeciwnik::class, inversedBy="mecze")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $przeciwnik;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $miejsce;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getWynikHome(): ?string
    {
        return $this->wynikHome;
    }

    public function setWynikHome(?string $wynikHome): self
    {
        $this->wynikHome = $wynikHome;

        return $this;
    }

    public function getWynikAway(): ?string
    {
        return $this->wynikAway;
    }

    public function setWynikAway(?string $wynikAway): self
    {
        $this->wynikAway = $wynikAway;

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

    public function getPrzeciwnik(): ?Przeciwnik
    {
        return $this->przeciwnik;
    }

    public function setPrzeciwnik(?Przeciwnik $przeciwnik): self
    {
        $this->przeciwnik = $przeciwnik;

        return $this;
    }

    public function getMiejsce(): ?string
    {
        return $this->miejsce;
    }

    public function setMiejsce(?string $miejsce): self
    {
        $this->miejsce = $miejsce;

        return $this;
    }

}
