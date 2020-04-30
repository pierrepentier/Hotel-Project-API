<?php

namespace App\Transformer;

use App\Entity\Chambre;
use App\DTO\ChambreDTO;


class ChambreTransformer
{
 
    public static function transformToDTO(Chambre $chambre){
        if($chambre == null) {
            return null;
        }
        $chambreDTO = (new ChambreDTO)->setNumeroChambre($chambre->getNumeroChambre())
                                      ->setHotelDTO(HotelTransformer::transformToDTO($chambre->getHotel()))
                                      ->setCategorieDTO(CategorieTransformer::transformToDTO($chambre->getCategorie()));

                                       
                                         

        return $chambreDTO;
    }

    public static function transformToEntity(ChambreDTO $chambreDTO){
        if($chambreDTO == null) {
            return null;
        }
        $chambre = (new Chambre)->setNumeroChambre($chambreDTO->getNumeroChambre())
                                ->setHotel(HotelTransformer::transformToEntity($chambreDTO->getHotelDTO()))
                                ->setCategorie(CategorieTransformer::transformToEntity($chambreDTO->getCategorieDTO()));
 
                                         

        return $chambre;
    }

    public static function transformToListOfDTOS(array $chambres){
        $chambresDTos = [];
        foreach ($chambres as $chambre) {
            $chambresDTos[] = self::transformToDTO($chambre);
        }
        return $chambresDTos;
    }

    public static function updateChambreEntityByNewChambreDTO(Chambre $chambre, ChambreDTO $newChambreDTO){
        $chambre->setNumeroChambre($newChambreDTO->getNumeroChambre())
                ->setHotel(HotelTransformer::transformToEntity($newChambreDTO->getHotelDTO()))
                ->setCategorie(CategorieTransformer::transformToEntity($newChambreDTO->getCategorieDTO()));                          


        return $chambre;
    }

}