<?php

namespace App\DTO;

use Doctrine\Common\Collections\ArrayCollection;


class ChambreDTO
{
    private $numeroChambre;
    private $hotelDTO;
    private $categorieDTO;



    public function getNumeroChambre(): ?int
    {
        return $this->numeroChambre;
    }

    public function setNumeroChambre(int $numeroChambre): self
    {
        $this->numeroChambre = $numeroChambre;

        return $this;
    }


    public function getHotelDTO(): ?HotelDTO
    {
        return $this->hotelDTO;
    }

    public function setHotelDTO(?HotelDTO $hotelDTO): self
    {
        $this->hotelDTO = $hotelDTO;

        return $this;
    }

    public function getCategorieDTO(): ?CategorieDTO
    {
        return $this->categorieDTO;
    }

    public function setCategorieDTO(?CategorieDTO $categorieDTO): self
    {
        $this->categorieDTO = $categorieDTO;

        return $this;
    }
}