<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nazwaShort;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $opis;

    /**
     * @ORM\Column(type="datetime")
     */
    private $utworzono;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modyfikacja;

    /**
     * @var Zawodnik[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Zawodnik", mappedBy="team")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * 
     */
    private $zawodnik;

    /**
     * @ORM\ManyToOne(targetEntity=KategoriaWiekowa::class, inversedBy="team")
     * @ORM\JoinColumn(nullable=true)
     */
    private $grupaWiekowa;

    /**
     * @ORM\ManyToOne(targetEntity=Trenerzy::class, inversedBy="team")
     * @ORM\JoinColumn(nullable=true)
     */
    private $trener;

    /**
     * @ORM\OneToMany(targetEntity=Treningi::class, mappedBy="druzyna")
     */
    private $treningi;

    /**
     * @ORM\OneToMany(targetEntity=Sezon::class, mappedBy="team", orphanRemoval=true)
     */
    private $sezon;

    /**
     * @@var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="teams")
     */
    private $owner;


    public function __construct()
    {
        $this->zawodnik = new ArrayCollection();
        $this->treningi = new ArrayCollection();
        $this->sezon = new ArrayCollection();
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


    public function getNazwaShort(): ?string
    {
        return $this->nazwaShort;
    }

    public function setNazwaShort(string $nazwaShort): self
    {
        $this->nazwaShort = $nazwaShort;

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

    public function getUtworzono(): ?\DateTimeInterface
    {
        return $this->utworzono;
    }

    public function setUtworzono(\DateTimeInterface $utworzono): self
    {
        $this->utworzono = $utworzono;

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

    /**
     * @return Collection|Zawodnik[]
     */
    public function getZawodnik(): Collection
    {
        return $this->zawodnik;
    }

    public function addZawodnik(Zawodnik $zawodnik): self
    {
        $this->zawodnik[] = $zawodnik;

        return $this;
    }

    /**
    * @param Zawodnik $zawodnik
    * 
    * @return $this
    */
    public function removeZawodnik(Zawodnik $zawodnik): self
    {
        
        $this->zawodnik->removeElement($zawodnik);

        return $this;
    }

    public function getGrupaWiekowa(): ?KategoriaWiekowa
    {
        return $this->grupaWiekowa;
    }

    public function setGrupaWiekowa(?KategoriaWiekowa $grupaWiekowa): self
    {
        $this->grupaWiekowa = $grupaWiekowa;

        return $this;
    }

    public function getTrener(): ?Trenerzy
    {
        return $this->trener;
    }

    public function setTrener(?Trenerzy $trener): self
    {
        $this->trener = $trener;

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
            $treningi->setDruzyna($this);
        }

        return $this;
    }

    public function removeTreningi(Treningi $treningi): self
    {
        if ($this->treningi->contains($treningi)) {
            $this->treningi->removeElement($treningi);
            // set the owning side to null (unless already changed)
            if ($treningi->getDruzyna() === $this) {
                $treningi->setDruzyna(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sezon[]
     */
    public function getSezon(): Collection
    {
        return $this->sezon;
    }

    public function addSezon(Sezon $sezon): self
    {
        if (!$this->sezon->contains($sezon)) {
            $this->sezon[] = $sezon;
            $sezon->setTeam($this);
        }

        return $this;
    }

    public function removeSezon(Sezon $sezon): self
    {
        if ($this->sezon->contains($sezon)) {
            $this->sezon->removeElement($sezon);
            // set the owning side to null (unless already changed)
            if ($sezon->getTeam() === $this) {
                $sezon->setTeam(null);
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
