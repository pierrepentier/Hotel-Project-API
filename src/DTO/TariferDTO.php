<?php

namespace App\DTO;


class TariferDTO
{
    private $tarif;
    private $categorieDTO;
    private $hotelDTO;

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

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

    public function getHotelDTO(): ?HotelDTO
    {
        return $this->hotelDTO;
    }

    public function setHotelDTO(?HotelDTO $hotelDTO): self
    {
        $this->hotelDTO = $hotelDTO;

        return $this;
    }
}