<?php

namespace App\Entity;

use App\Repository\PrzeciwnikRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrzeciwnikRepository::class)
 */
class Przeciwnik
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
     * 
     * @var Sezon
     * 
     * @ORM\ManyToOne(targetEntity=Sezon::class, inversedBy="przeciwnik")
     * @ORM\JoinColumn(name="sezon_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $sezon;

    /**
     * @ORM\OneToMany(targetEntity=Mecze::class, mappedBy="przeciwnik")
     */
    private $mecze;

    public function __construct()
    {
        $this->mecze = new ArrayCollection();
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

    public function __toString()
    {
        return $this->nazwa;
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

    public function getSezon(): ?Sezon
    {
        return $this->sezon;
    }

    public function setSezon(?Sezon $sezon): self
    {
        $this->sezon = $sezon;

        return $this;
    }

    /**
     * @return Collection|Mecze[]
     */
    public function getMecze(): Collection
    {
        return $this->mecze;
    }

    public function addMecze(Mecze $mecze): self
    {
        if (!$this->mecze->contains($mecze)) {
            $this->mecze[] = $mecze;
            $mecze->setPrzeciwnik($this);
        }

        return $this;
    }

    public function removeMecze(Mecze $mecze): self
    {
        if ($this->mecze->contains($mecze)) {
            $this->mecze->removeElement($mecze);
            // set the owning side to null (unless already changed)
            if ($mecze->getPrzeciwnik() === $this) {
                $mecze->setPrzeciwnik(null);
            }
        }

        return $this;
    }

}
