<?php

namespace App\Service;

use App\DTO\CategorieDTO;
use App\Repository\CategorieRepository;
use App\Transformer\CategorieTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;

class CategorieService {

    private $categorieRepository;
    private $categorieEntityManager;

    public function __construct(EntityManagerInterface $manager, CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->categorieEntityManager = $manager;
    }

    public function findAllCategories(){
        $categories = $this->categorieRepository->findAll();
        $categoriesDTOs = CategorieTransformer::transformToListOfDTOS($categories);
        return $categoriesDTOs;
    }

    public function addNewCategorie(CategorieDTO $categorieDTO){
        if($categorieDTO == null){
            throw new Exception("Contenu de la requête Post est vide.");
        }
        $categorie = CategorieTransformer::transformToEntity($categorieDTO);
        if ($categorie != null) {
            $this->categorieEntityManager->persist($categorie);
            $this->categorieEntityManager->flush();
        }
    }

    public function updateCategorie(int $id, CategorieDTO $newCategorieDTO){
        $categorie = $this->categorieRepository->find($id);
        if($categorie == null){
            throw new Exception("Categorie avec l'id $id non trouvée. Pas possible de la mettre à jour");
        }
        $categorie = CategorieTransformer::updateCategorieEntityByNewCategorieDTO($categorie, $newCategorieDTO);
        
        try {
            $this->categorieEntityManager->persist($categorie);
            $this->categorieEntityManager->flush();
        } catch (QueryException $queryException){
            throw $queryException;
        }

    }
}