<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *      fields={"email"},
 *      message="Wskazany email widnieje już w bazie. "
 * )
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(
     *     message = "Wskazano niepoprawny adres skrytki pocztowej"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 8,
     *      minMessage = "Hasło musi mieć conajmniej {{ limit }} znaków długości",       
     * )
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Hasła muszą być identyczne")
     */
    public $confirm_password;

    /**
     * @var Zawodnik[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Zawodnik", mappedBy="owner")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $zawodnicy;

    /**
     * @var Trenerzy[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Trenerzy", mappedBy="owner")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $trenerzy;

    /**
     * @var Team[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Team", mappedBy="owner")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $teams;

    /**
     * @var Konspekt[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Konspekt", mappedBy="owner")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $konspekty;

    /**
     * @var Treningi[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Treningi", mappedBy="owner")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $treningi;

    /**
     * @var Sezon[]|ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Sezon", mappedBy="owner")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $sezony;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $imie;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $nazwisko;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $klub;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $miejscowosc;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $kodPocztowy;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $poczta;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $www;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataAktualizacji;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     * 
     */
    private $roles = [];

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials()
    {
        
    }

    public function getSalt()
    {
        
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->email,
            $this->password
        ]);
    }

    public function unserialize($string)
    {
        list (
            $this->id,
            $this->username,
            $this->email,
            $this->password,
        ) = unserialize($string, [
            'allowed_classes' => false
        ]);
    }

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->enebled = false;
        $this->roles = array();
        $this->zawodnik = new ArrayCollection();
        $this->zawodnicy = new ArrayCollection();
        $this->trenerzy = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->konspekty = new ArrayCollection();
        $this->treningi = new ArrayCollection();
        $this->sezony = new ArrayCollection();

    }

    /**
     * @return Collection|Zawodnik[]
     */
    public function getZawodnicy(): Collection
    {
        return $this->zawodnicy;
    }

    public function addZawodnicy(Zawodnik $zawodnicy): self
    {
        $this->zawodnicy[] = $zawodnicy;

        return $this;
    }

    /**
     * @param Zawodnik $zawodnicy
     * 
     * @return $this
     */
    public function removeZawodnicy(Zawodnik $zawodnicy): self
    {
        $this->zawodnicy->removeElement($zawodnicy);

        return $this;
    }

    public function getImie(): ?string
    {
        return $this->imie;
    }

    public function setImie(?string $imie): self
    {
        $this->imie = $imie;

        return $this;
    }

    public function getNazwisko(): ?string
    {
        return $this->nazwisko;
    }

    public function setNazwisko(?string $nazwisko): self
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    public function getKlub(): ?string
    {
        return $this->klub;
    }

    public function setKlub(?string $klub): self
    {
        $this->klub = $klub;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(?string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getMiejscowosc(): ?string
    {
        return $this->miejscowosc;
    }

    public function setMiejscowosc(?string $miejscowosc): self
    {
        $this->miejscowosc = $miejscowosc;

        return $this;
    }

    public function getKodPocztowy(): ?string
    {
        return $this->kodPocztowy;
    }

    public function setKodPocztowy(?string $kodPocztowy): self
    {
        $this->kodPocztowy = $kodPocztowy;

        return $this;
    }

    public function getPoczta(): ?string
    {
        return $this->poczta;
    }

    public function setPoczta(?string $poczta): self
    {
        $this->poczta = $poczta;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(?string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getWww(): ?string
    {
        return $this->www;
    }

    public function setWww(?string $www): self
    {
        $this->www = $www;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDataAktualizacji(): ?\DateTimeInterface
    {
        return $this->dataAktualizacji;
    }

    public function setDataAktualizacji(\DateTimeInterface $dataAktualizacji): self
    {
        $this->dataAktualizacji = $dataAktualizacji;

        return $this;
    }

        /**
     * @return Collection|Trenerzy[]
     */
    public function getTrenerzy(): Collection
    {
        return $this->trenerzy;
    }

    public function addTrenerzy(Trenerzy $trenerzy): self
    {
        $this->trenerzy[] = $trenerzy;

        return $this;
    }

    /**
     * @param Trenerzy $trenerzy
     * 
     * @return $this
     */

    public function removeTrenerzy(Trenerzy $trenerzy): self
    {
        $this->trenerzy->removeElement($trenerzy);

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeams(Team $teams): self
    {
        $this->teams[] = $teams;

        return $this;
    }

    /**
     * @param Team $teams
     * 
     * @return $this
     */
    public function removeTeams(Team $teams): self
    {
        $this->teams->removeElement($teams);

        return $this;
    }

    /**
     * @return Collection|Konspekt[]
     */
    public function getKonspekty(): Collection
    {
        return $this->konspekty;
    }

    public function addKonspekty(Konspekt $konspekty): self
    {
        $this->konspekty[] = $konspekty;

        return $this;
    }

    /**
     * @param Konspekt $konspekty
     * 
     * @return $this
     */
    public function removeKonspekty(Konspekt $konspekty): self
    {
        $this->konspekty->removeElement($konspekty);

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
        $this->treningi[] = $treningi;

        return $this;
    }

    /**
     * @param Treningi $treningi
     * 
     * @return $this
     */
    public function removeTreningi(Treningi $treningi): self
    {
        $this->treningi->removeElement($treningi);

        return $this;
    }

    /**
     * @return Collection|Sezon[]
     */
    public function getSezony(): Collection
    {
        return $this->sezony;
    }

    public function addSezony(Sezon $sezony): self
    {
        $this->sezony[] = $sezony;

        return $this;
    }

    /**
     * @param Sezon $sezony
     * 
     * @return $this
     */
    public function removeSezony(Sezon $sezony): self
    {
        $this->sezony->removeElement($sezony);

        return $this;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setOwner($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getOwner() === $this) {
                $team->setOwner(null);
            }
        }

        return $this;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

}
