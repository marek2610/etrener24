<?php

namespace App\Entity;

use App\Repository\ZawodnikRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Krew;

/**
 * @ORM\Entity(repositoryClass=ZawodnikRepository::class)
 */
class Zawodnik
{
    # zawodnik aktywny
    const STATUS_ACTIVE = 'active';
    # zawodnik usunięty przez użytkownika
    const STATUS_UNACTIVE = 'unactive';
    # zawodnik usunięty z bazy
    const STATUS_DELETE = 'delete';
    # zawodnik aktywny
    const STATUS_INJURED = 'kontuzjowany';



    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *   message = "Pole nie może być puste."
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Pole powinno posiadać minimalną długość {{ limit }} znaków",
     *      maxMessage = "Pole powinno posiadać maksymalną długość {{ limit }} znaków",
     * )
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *   message = "Pole nie może być puste."
     * )
     * @Assert\Length(
     *      min = 3,
     *      max = 60,
     *      minMessage = "Pole powinno posiadać minimalną długość {{ limit }} znaków",
     *      maxMessage = "Pole powinno posiadać maksymalną długość {{ limit }} znaków",
     * )
     */
    private $nazwisko;

    # @Assert\LessThan("-5 years", message = "Zawodnik nie może być niż młodszy 5 lat.")

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataUrodzenia;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     * @Assert\Length(
     *      min = 11,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     * )
     */
    private $pesel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $miejsceUrodzenia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $kodPocztowy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $miejscowosc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poczta;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $noga;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $szkola;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $wzrost;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\GreaterThan(
     *      value = 10,
     * )
     */
    private $waga;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pozycja;

    /**
     * @ORM\ManyToOne(targetEntity="Krew", inversedBy="zawodnik")
     */
    private $grupaKrwi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pierwszyKlub;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numerNaKoszulce;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nrKartyZawodnika;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dataWaznosciKarty;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dataRejestracjiWKlubie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imieRodzica;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $naziwskoRodzica;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $emailRodzica;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nrTelefonuRodzica;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dataUtworzenia;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dataModyfikacji;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $status;

    /**
     * @var Urazy[]
     * 
     * @ORM\OneToMany(targetEntity="Urazy", mappedBy="zawodnik")
     * 
     */
    private $urazy;

    /**
     * @@var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="zawodnicy")
     */
    private $owner;

    #@ORM\JoinColumn(nullable=true, onDelete="CASCADE")
    /**
     * @var Team
     * 
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="zawodnik")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $team;

    /**
     * Zawodnik constructor.
     */
    public function __construct()
    {
        $this->urazy = new ArrayCollection();
        // $this->team = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    public function getDataUrodzenia(): ?\DateTimeInterface
    {
        return $this->dataUrodzenia;
    }

    public function setDataUrodzenia(?\DateTimeInterface $dataUrodzenia): self
    {
        $this->dataUrodzenia = $dataUrodzenia;

        return $this;
    }

    public function getPesel(): ?string
    {
        return $this->pesel;
    }

    public function setPesel(string $pesel): self
    {
        $this->pesel = $pesel;

        return $this;
    }

    public function getMiejsceUrodzenia(): ?string
    {
        return $this->miejsceUrodzenia;
    }

    public function setMiejsceUrodzenia(string $miejsceUrodzenia): self
    {
        $this->miejsceUrodzenia = $miejsceUrodzenia;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getKodPocztowy(): ?string
    {
        return $this->kodPocztowy;
    }

    public function setKodPocztowy(string $kodPocztowy): self
    {
        $this->kodPocztowy = $kodPocztowy;

        return $this;
    }

    public function getMiejscowosc(): ?string
    {
        return $this->miejscowosc;
    }

    public function setMiejscowosc(string $miejscowosc): self
    {
        $this->miejscowosc = $miejscowosc;

        return $this;
    }

    public function getPoczta(): ?string
    {
        return $this->poczta;
    }

    public function setPoczta(string $poczta): self
    {
        $this->poczta = $poczta;

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

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getDataUtworzenia(): ?\DateTimeInterface
    {
        return $this->dataUtworzenia;
    }

    public function setDataUtworzenia(\DateTimeInterface $dataUtworzenia): self
    {
        $this->dataUtworzenia = $dataUtworzenia;

        return $this;
    }

    public function getDataModyfikacji(): ?\DateTimeInterface
    {
        return $this->dataModyfikacji;
    }

    public function setDataModyfikacji(\DateTimeInterface $dataModyfikacji): self
    {
        $this->dataModyfikacji = $dataModyfikacji;

        return $this;
    }

    public function getNoga(): ?string
    {
        return $this->noga;
    }

    public function setNoga(string $noga): self
    {
        $this->noga = $noga;

        return $this;
    }

    public function getSzkola(): ?string
    {
        return $this->szkola;
    }

    public function setSzkola(string $szkola): self
    {
        $this->szkola = $szkola;

        return $this;
    }

    public function getWzrost(): ?int
    {
        return $this->wzrost;
    }

    public function setWzrost(int $wzrost): self
    {
        $this->wzrost = $wzrost;

        return $this;
    }

    public function getWaga(): ?int
    {
        return $this->waga;
    }

    public function setWaga(int $waga): self
    {
        $this->waga = $waga;

        return $this;
    }

    public function getPozycja(): ?string
    {
        return $this->pozycja;
    }

    public function setPozycja(string $pozycja): self
    {
        $this->pozycja = $pozycja;

        return $this;
    }

    public function getGrupaKrwi(): ?Krew
    {
        return $this->grupaKrwi;
    }

    public function setGrupaKrwi(Krew $grupaKrwi): self
    {
        $this->grupaKrwi = $grupaKrwi;

        return $this;
    }

    public function getPierwszyKlub(): ?string
    {
        return $this->pierwszyKlub;
    }

    public function setPierwszyKlub(string $pierwszyKlub): self
    {
        $this->pierwszyKlub = $pierwszyKlub;

        return $this;
    }

    public function getNumerNaKoszulce(): ?string
    {
        return $this->numerNaKoszulce;
    }

    public function setNumerNaKoszulce(string $numerNaKoszulce): self
    {
        $this->numerNaKoszulce = $numerNaKoszulce;

        return $this;
    }

    public function getNrKartyZawodnika(): ?string
    {
        return $this->nrKartyZawodnika;
    }

    public function setNrKartyZawodnika(string $nrKartyZawodnika): self
    {
        $this->nrKartyZawodnika = $nrKartyZawodnika;

        return $this;
    }

    public function getDataWaznosciKarty(): ?\DateTimeInterface
    {
        return $this->dataWaznosciKarty;
    }

    public function setDataWaznosciKarty(\DateTimeInterface $dataWaznosciKarty): self
    {
        $this->dataWaznosciKarty = $dataWaznosciKarty;

        return $this;
    }

    public function getDataRejestracjiWKlubie(): ?\DateTimeInterface
    {
        return $this->dataRejestracjiWKlubie;
    }

    public function setDataRejestracjiWKlubie(\DateTimeInterface $dataRejestracjiWKlubie): self
    {
        $this->dataRejestracjiWKlubie = $dataRejestracjiWKlubie;

        return $this;
    }

    public function getImieRodzica(): ?string
    {
        return $this->imieRodzica;
    }

    public function setImieRodzica(string $imieRodzica): self
    {
        $this->imieRodzica = $imieRodzica;

        return $this;
    }

    public function getNaziwskoRodzica(): ?string
    {
        return $this->naziwskoRodzica;
    }

    public function setNaziwskoRodzica(string $naziwskoRodzica): self
    {
        $this->naziwskoRodzica = $naziwskoRodzica;

        return $this;
    }

    public function getEmailRodzica(): ?string
    {
        return $this->emailRodzica;
    }

    public function setEmailRodzica(string $emailRodzica): self
    {
        $this->emailRodzica = $emailRodzica;

        return $this;
    }

    public function getNrTelefonuRodzica(): ?string
    {
        return $this->nrTelefonuRodzica;
    }

    public function setNrTelefonuRodzica(string $nrTelefonuRodzica): self
    {
        $this->nrTelefonuRodzica = $nrTelefonuRodzica;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Urazy[]
     */
    public function getUrazy()
    {
        return $this->urazy;
    }

    /**
     * @param Urazy $urazy
     * 
     * @return $this
     */
    public function addUrazy(Urazy $urazy): self
    {
        // WYGENEROWANE AUTOMATYCZNIE
        // if (!$this->urazy->contains($urazy)) {
        //     $this->urazy[] = $urazy;
        //     $urazy->setZawodnik($this);
        // }

        $this->urazy[] = $urazy;

        return $this;
    }

    // WYGENEROWANE AUTOMATYCZNIE
    // public function removeUrazy(Zawodnik $urazy): self
    // {
    //     if ($this->urazy->contains($urazy)) {
    //         $this->urazy->removeElement($urazy);
    //         // set the owning side to null (unless already changed)
    //         if ($urazy->getZawodnik() === $this) {
    //             $urazy->setZawodnik(null);
    //         }
    //     }

    //     return $this;
    // }


    // public function removeUrazy(Zawodnik $urazy): self
    // {
    //     if ($this->urazy->contains($urazy)) {
    //         $this->urazy->removeElement($urazy);
    //         // set the owning side to null (unless already changed)
    //         if ($urazy->getZawodnik() === $this) {
    //             $urazy->setZawodnik(null);
    //         }
    //     }

    //     return $this;
    // }


    ###################################


    // public function removeUrazy(Urazy $urazy): self
    // {
    //     if ($this->urazy->contains($urazy)) {
    //         $this->urazy->removeElement($urazy);
    //         // set the owning side to null (unless already changed)
    //         if ($urazy->getZawodnik() === $this) {
    //             $urazy->setZawodnik(null);
    //         }
    //     }

    //     return $this;
    // }


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

    /**
    * @return Team
    */
    public function getTeam(): ?Team
    {
        return $this->team;
    }

    /**
    * @param Team $team
    * 
    * @return $this
    */
    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }

    // public function removeUrazy(Urazy $urazy): self
    // {
    //     if ($this->urazy->contains($urazy)) {
    //         $this->urazy->removeElement($urazy);
    //         // set the owning side to null (unless already changed)
    //         if ($urazy->getZawodnik() === $this) {
    //             $urazy->setZawodnik(null);
    //         }
    //     }

    //     return $this;
    // }


    public function removeUrazy(Urazy $urazy): self
    {
        if ($this->urazy->contains($urazy)) {
            $this->urazy->removeElement($urazy);
            // set the owning side to null (unless already changed)
            if ($urazy->getZawodnik() === $this) {
                $urazy->setZawodnik(null);
            }
        }

        return $this;
    }
}