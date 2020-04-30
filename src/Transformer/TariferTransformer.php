<?php

namespace App\Transformer;

use App\Entity\Tarifer;
use App\DTO\TariferDTO;


class TariferTransformer
{
 
    public static function transformToDTO(Tarifer $tarifer){
        if($tarifer == null) {
            return null;
        }
        $tariferDTO = (new TariferDTO)->setTarif($tarifer->getTarif())
                                      ->setHotelDTO(HotelTransformer::transformToDTO($tarifer->getHotel()))
                                      ->setCategorieDTO(CategorieTransformer::transformToDTO($tarifer->getCategorie()));


        return $tariferDTO;
    }

    public static function transformToEntity(TariferDTO $tariferDTO){
        if($tariferDTO == null) {
            return null;
        }
        $tarifer = (new Tarifer)->setTarif($tariferDTO->getTarif())
                                ->setHotel(HotelTransformer::transformToEntity($tariferDTO->getHotelDTO()))
                                ->setCategorie(CategorieTransformer::transformToEntity($tariferDTO->getCategorieDTO()));
                                        
        return $tarifer;
    }

    public static function transformToListOfDTOS(array $tarifers){
        $tarifersDTos = [];
        foreach ($tarifers as $tarifer) {
            $tarifersDTos[] = self::transformToDTO($tarifer);
        }
        return $tarifersDTos;
    }

    public static function updateTariferEntityByNewTariferDTO(Tarifer $tarifer, TariferDTO $newTariferDTO){

        $tarifer->setTarif($newTariferDTO->getTarif())
                ->setHotel(HotelTransformer::transformToEntity($newTariferDTO->getHotelDTO()))
                ->setCategorie(CategorieTransformer::transformToEntity($newTariferDTO->getCategorieDTO()));

        return $tarifer;
    }

}