<?php

namespace App\Service;

use App\DTO\TariferDTO;
use App\Repository\TariferRepository;
use App\Transformer\TariferTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;

class TariferService {

    private $tariferRepository;
    private $tariferEntityManager;

    public function __construct(EntityManagerInterface $manager, TariferRepository $tariferRepository)
    {
        $this->tariferRepository = $tariferRepository;
        $this->tariferEntityManager = $manager;
    }

    public function findAllTarifers(){
        $tarifers = $this->tariferRepository->findAll();
        $tarifersDTOs = TariferTransformer::transformToListOfDTOS($tarifers);
        return $tarifersDTOs;
    }

    public function addNewTarifer(TariferDTO $tariferDTO){
        if($tariferDTO == null){
            throw new Exception("Contenu de la requête Post est vide.");
        }
        $tarifer = TariferTransformer::transformToEntity($tariferDTO);
        if ($tarifer != null) {
            $this->tariferEntityManager->persist($tarifer);
            $this->tariferEntityManager->flush();
        }
    }

    public function updateTarifer(int $id, TariferDTO $newTariferDTO){
        $tarifer = $this->tariferRepository->find($id);
        if($tarifer == null){
            throw new Exception("Tarifer avec l'id $id non trouvée. Pas possible de la mettre à jour");
        }
        $tarifer = TariferTransformer::updateTariferEntityByNewTariferDTO($tarifer, $newTariferDTO);
        
        try {
            $this->tariferEntityManager->persist($tarifer);
            $this->tariferEntityManager->flush();
        } catch (QueryException $queryException){
            throw $queryException;
        }

    }
}