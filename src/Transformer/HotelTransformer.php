<?php

namespace App\Transformer;

use App\Entity\Hotel;
use App\DTO\HotelDTO;


class HotelTransformer
{
 
    public static function transformToDTO(Hotel $hotel){
        if($hotel == null) {
            return null;
        }
        $hotelDTO = (new HotelDTO)->setNom($hotel->getNom())
                                  ->setNumeroAdresse($hotel->getNumeroAdresse())
                                  ->setNomAdresse($hotel->getNomAdresse())
                                  ->setVille($hotel->getVille())
                                  ->setCodePostal($hotel->getCodepostal())
                                  ->setPays($hotel->getPays())
                                  ->setTelephone($hotel->getTelephone())
                                  ->setEmail($hotel->getEmail());
                                         

        return $hotelDTO;
    }

    public static function transformToEntity(HotelDTO $hotelDTO){
        if($hotelDTO == null) {
            return null;
        }
        $hotel = (new Hotel)->setNom($hotelDTO->getNom())
                            ->setNumeroAdresse($hotelDTO->getNumeroAdresse())
                            ->setNomAdresse($hotelDTO->getNomAdresse())
                            ->setVille($hotelDTO->getVille())
                            ->setCodePostal($hotelDTO->getCodepostal())
                            ->setPays($hotelDTO->getPays())
                            ->setTelephone($hotelDTO->getTelephone())
                            ->setEmail($hotelDTO->getEmail());
                                          

        return $hotel;
    }

    public static function transformToListOfDTOS(array $hotels){
        $hotelsDTos = [];
        foreach ($hotels as $hotel) {
            $hotelsDTos[] = self::transformToDTO($hotel);
        }
        return $hotelsDTos;
    }

    public static function updateHotelEntityByNewHotelDTO(Hotel $hotel, HotelDTO $newHotelDTO){

        $hotel->setNom($newHotelDTO->getNom())
              ->setNumeroAdresse($newHotelDTO->getNumeroAdresse())
              ->setNomAdresse($newHotelDTO->getNomAdresse())
              ->setVille($newHotelDTO->getVille())
              ->setCodePostal($newHotelDTO->getCodepostal())
              ->setPays($newHotelDTO->getPays())
              ->setTelephone($newHotelDTO->getTelephone())
              ->setEmail($newHotelDTO->getEmail());
                                  

        return $hotel;

    }

}