<?php

namespace App\Entity;

use App\Repository\KrewRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=KrewRepository::class)
 */
class Krew
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank(message="Pole nie może być puste.")
     * @Assert\Length(
     *      max = 7,
     *      maxMessage = "Wartość {{ value }} jest zbyt długa. Pole nie może mieć więcej niż {{ limit }} znaków",
     * )
     */
    private $grupa;

    /**
     * @ORM\OneToMany(targetEntity="Zawodnik", mappedBy="grupaKrwi")
     */
    private $zawodnik;

    public function __construct()
    {
        $this->zawodnik = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
    
    public function __toString()
    {
        return $this->grupa;
    }

    /**
     * @return Collection|Zawodnik[]
     */
    public function getZawodnik(): Collection
    {
        return $this->zawodnik;
    }

    public function addZawodnik(Zawodnik $zawodnik): self
    {
        if (!$this->zawodnik->contains($zawodnik)) {
            $this->zawodnik[] = $zawodnik;
            $zawodnik->setGrupaKrwi($this);
        }

        return $this;
    }

    // public function removeZawodnik(Zawodnik $zawodnik): self
    // {
    //     if ($this->zawodnik->contains($zawodnik)) {
    //         $this->zawodnik->removeElement($zawodnik);
    //         // set the owning side to null (unless already changed)
    //         if ($zawodnik->getGrupaKrwi() === $this) {
    //             $zawodnik->setGrupaKrwi(null);
    //         }
    //     }

    //     return $this;
    // }


    public function removeZawodnik(Zawodnik $zawodnik): self
    {
        if ($this->zawodnik->contains($zawodnik)) {
            $this->zawodnik->removeElement($zawodnik);
            // set the owning side to null (unless already changed)
            if ($zawodnik->getGrupaKrwi() === $this) {
                $zawodnik->setGrupaKrwi(null);
            }
        }

        return $this;
    }
}
