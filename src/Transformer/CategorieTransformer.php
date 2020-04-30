<?php

namespace App\Transformer;

use App\Entity\Categorie;
use App\DTO\CategorieDTO;


class CategorieTransformer
{
 
    public static function transformToDTO(Categorie $categorie){
        if($categorie == null) {
            return null;
        }
        $categorieDTO = (new CategorieDTO)->setNbrePersonnes($categorie->getNbrePersonnes())
                                          ->setLitSimple($categorie->getLitSimple())
                                          ->setLitDouble($categorie->getLitDouble())
                                          ->setLitKing($categorie->getLitKing())
                                          ->setNom($categorie->getNom());


        return $categorieDTO;
    }

    public static function transformToEntity(CategorieDTO $categorieDTO){
        if($categorieDTO == null) {
            return null;
        }
        $categorie = (new Categorie)->setNbrePersonnes($categorieDTO->getNbrePersonnes())
                                    ->setLitSimple($categorieDTO->getLitSimple())
                                    ->setLitDouble($categorieDTO->getLitDouble())
                                    ->setLitKing($categorieDTO->getLitKing())
                                    ->setNom($categorieDTO->getNom());
                                 

        return $categorie;
    }

    public static function transformToListOfDTOS(array $categories){
        $categoriesDTos = [];
        foreach ($categories as $categorie) {
            $categoriesDTos[] = self::transformToDTO($categorie);
        }
        return $categoriesDTos;
    }

    public static function updateCategorieEntityByNewCategorieDTO(Categorie $categorie, CategorieDTO $newCategorieDTO){
        $categorie->setNbrePersonnes($newCategorieDTO->getNbrePersonnes())
                  ->setLitSimple($newCategorieDTO->getLitSimple())
                  ->setLitDouble($newCategorieDTO->getLitDouble())
                  ->setLitKing($newCategorieDTO->getLitKing())
                  ->setNom($newCategorieDTO->getNom());
                         


        return $categorie;
    }

}
