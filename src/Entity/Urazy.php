<?php

namespace App\Entity;

use App\Repository\UrazyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UrazyRepository::class)
 */
class Urazy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *      message = "Pole nie może być puste."
     * )
     */
    private $rozpoznanie;

    /**
     * @ORM\Column(type="text")
     */
    private $zalecenia;

    /**
     * @ORM\Column(type="text")
     */
    private $rehabilitacja;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataKontuzji;

    /**
     * @ORM\Column(type="text")
     */
    private $uwagi;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataUtworzenia;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataModyfikacji;

    /**
     * @var Zawodnik
     * 
     * @ORM\ManyToOne(targetEntity="Zawodnik", inversedBy="urazy")
     * @ORM\JoinColumn(name="zawodnik_id", referencedColumnName="id",onDelete="CASCADE")
     * 
     */
    private $zawodnik;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUraz(): ?string
    {
        return $this->uraz;
    }

    public function setUraz(string $uraz): self
    {
        $this->uraz = $uraz;

        return $this;
    }

    public function getOpis(): ?string
    {
        return $this->opis;
    }

    public function setOpis(string $opis): self
    {
        $this->opis = $opis;

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

    public function getRozpoznanie(): ?string
    {
        return $this->rozpoznanie;
    }

    public function setRozpoznanie(string $rozpoznanie): self
    {
        $this->rozpoznanie = $rozpoznanie;

        return $this;
    }

    public function getRehabilitacja(): ?string
    {
        return $this->rehabilitacja;
    }

    public function setRehabilitacja(string $rehabilitacja): self
    {
        $this->rehabilitacja = $rehabilitacja;

        return $this;
    }

    public function getDataKontuzji(): ?\DateTimeInterface
    {
        return $this->dataKontuzji;
    }

    public function setDataKontuzji(?\DateTimeInterface $dataKontuzji): self
    {
        $this->dataKontuzji = $dataKontuzji;

        return $this;
    }

    public function getZalecenia(): ?string
    {
        return $this->zalecenia;
    }

    public function setZalecenia(string $zalecenia): self
    {
        $this->zalecenia = $zalecenia;

        return $this;
    }

    public function getUwagi(): ?string
    {
        return $this->uwagi;
    }

    public function setUwagi(string $uwagi): self
    {
        $this->uwagi = $uwagi;

        return $this;
    }

    public function getZawodnik(): ?Zawodnik
    {
        return $this->zawodnik;
    }

    public function setZawodnik(?Zawodnik $zawodnik): self
    {
        $this->zawodnik = $zawodnik;

        return $this;
    }
}
