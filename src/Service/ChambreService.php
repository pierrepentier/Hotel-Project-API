<?php

namespace App\Service;

use App\DTO\ChambreDTO;
use App\Repository\ChambreRepository;
use App\Transformer\ChambreTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;

class ChambreService {

    private $chambreRepository;
    private $chambreEntityManager;

    public function __construct(EntityManagerInterface $manager, ChambreRepository $chambreRepository)
    {
        $this->chambreRepository = $chambreRepository;
        $this->chambreEntityManager = $manager;
    }

    public function findAllChambres(){
        $chambres = $this->chambreRepository->findAll();
        $chambresDTOs = ChambreTransformer::transformToListOfDTOS($chambres);
        return $chambresDTOs;
    }

    public function addNewChambre(ChambreDTO $chambreDTO){
        if($chambreDTO == null){
            throw new Exception("Contenu de la requête Post est vide.");
        }
        $chambre = ChambreTransformer::transformToEntity($chambreDTO);
        if ($chambre != null) {
            $this->chambreEntityManager->persist($chambre);
            $this->chambreEntityManager->flush();
        }
    }

    public function updateChambre(int $id, ChambreDTO $newChambreDTO){
        $chambre = $this->chambreRepository->find($id);
        if($chambre == null){
            throw new Exception("Chambre avec l'id $id non trouvée. Pas possible de la mettre à jour");
        }
        $chambre = ChambreTransformer::updateChambreEntityByNewChambreDTO($chambre, $newChambreDTO);
        
        try {
            $this->chambreEntityManager->persist($chambre);
            $this->chambreEntityManager->flush();
        } catch (QueryException $queryException){
            throw $queryException;
        }

    }
}