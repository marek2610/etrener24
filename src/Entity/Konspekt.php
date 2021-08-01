<?php

namespace App\Entity;

use App\Repository\KonspektRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KonspektRepository::class)
 */
class Konspekt
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $temat;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $czasZajec;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pilki;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $bramki;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $oznaczniki;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $stozki;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pacholki;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tyczki;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $drabinki;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $inne;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opis;

    /**
     * @ORM\Column(type="datetime")
     */
    private $utworzony;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modyfikacja;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $opisZajec;

    /**
     * @ORM\OneToMany(targetEntity=Treningi::class, mappedBy="konspekt")
     */
    private $treningi;

    /**
     * @@var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="konspekty")
     */
    private $owner;

    public function __construct()
    {
        $this->treningi = new ArrayCollection();

    }

    public function __toString()
    {
        return $this->nazwa;
        return $this->temat;
        return $this->opis;
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

    public function getTemat(): ?string
    {
        return $this->temat;
    }

    public function setTemat(?string $temat): self
    {
        $this->temat = $temat;

        return $this;
    }

    public function getCzasZajec(): ?float
    {
        return $this->czasZajec;
    }

    public function setCzasZajec(?float $czasZajec): self
    {
        $this->czasZajec = $czasZajec;

        return $this;
    }

    public function getPilki(): ?float
    {
        return $this->pilki;
    }

    public function setPilki(?float $pilki): self
    {
        $this->pilki = $pilki;

        return $this;
    }

    public function getBramki(): ?float
    {
        return $this->bramki;
    }

    public function setBramki(?float $bramki): self
    {
        $this->bramki = $bramki;

        return $this;
    }

    public function getOznaczniki(): ?float
    {
        return $this->oznaczniki;
    }

    public function setOznaczniki(?float $oznaczniki): self
    {
        $this->oznaczniki = $oznaczniki;

        return $this;
    }

    public function getStozki(): ?float
    {
        return $this->stozki;
    }

    public function setStozki(?float $stozki): self
    {
        $this->stozki = $stozki;

        return $this;
    }

    public function getPacholki(): ?float
    {
        return $this->pacholki;
    }

    public function setPacholki(?float $pacholki): self
    {
        $this->pacholki = $pacholki;

        return $this;
    }

    public function getTyczki(): ?float
    {
        return $this->tyczki;
    }

    public function setTyczki(?float $tyczki): self
    {
        $this->tyczki = $tyczki;

        return $this;
    }

    public function getDrabinki(): ?float
    {
        return $this->drabinki;
    }

    public function setDrabinki(?float $drabinki): self
    {
        $this->drabinki = $drabinki;

        return $this;
    }

    public function getInne(): ?string
    {
        return $this->inne;
    }

    public function setInne(?string $inne): self
    {
        $this->inne = $inne;

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

    public function getOpisZajec(): ?string
    {
        return $this->opisZajec;
    }

    public function setOpisZajec(?string $opisZajec): self
    {
        $this->opisZajec = $opisZajec;

        return $this;
    }

    /**
     * @return Collection|Treningi[]
     */
    public function getTreningi(): Collection
    {
        return $this->treningi;
    }

    public function addTreningi(Treningi $treningi): self
    {
        if (!$this->treningi->contains($treningi)) {
            $this->treningi[] = $treningi;
            $treningi->setKonspekt($this);
        }

        return $this;
    }

    public function removeTreningi(Treningi $treningi): self
    {
        if ($this->treningi->contains($treningi)) {
            $this->treningi->removeElement($treningi);
            // set the owning side to null (unless already changed)
            if ($treningi->getKonspekt() === $this) {
                $treningi->setKonspekt(null);
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
