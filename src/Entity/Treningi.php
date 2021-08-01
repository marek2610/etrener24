<?php

namespace App\Entity;

use App\Repository\TreningiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TreningiRepository::class)
 */
class Treningi
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
     * @ORM\ManyToOne(targetEntity=Team::class, inversedBy="treningi")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $druzyna;

    /**
     * @ORM\Column(type="datetime")
     */
    private $utworzono;

    /**
     * @ORM\Column(type="datetime")
     */
    private $modyfikacja;

    /**
     * @ORM\ManyToOne(targetEntity=Konspekt::class, inversedBy="treningi")
     */
    private $konspekt;

    /**
     * @@var User
     * 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="treningi")
     */
    private $owner;

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

    public function getDruzyna(): ?Team
    {
        return $this->druzyna;
    }

    public function setDruzyna(?Team $druzyna): self
    {
        $this->druzyna = $druzyna;

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

    public function getKonspekt(): ?Konspekt
    {
        return $this->konspekt;
    }

    public function setKonspekt(?Konspekt $konspekt): self
    {
        $this->konspekt = $konspekt;

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
