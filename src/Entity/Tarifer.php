<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TariferRepository")
 */
class Tarifer
{

    /**
     * @ORM\Column(type="float")
     */
    private $tarif;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="tarifers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="tarifers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
