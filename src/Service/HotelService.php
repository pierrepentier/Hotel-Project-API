<?php

namespace App\Service;

use App\DTO\HotelDTO;
use App\Repository\HotelRepository;
use App\Transformer\HotelTransformer;
use App\Transformer\CategorieTransformer;
use App\Transformer\ChambreTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;

class HotelService {

    private $hotelRepository;
    private $hotelEntityManager;

    public function __construct(EntityManagerInterface $manager, HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->hotelEntityManager = $manager;
    }

    public function findAllHotels(){
        $hotels = $this->hotelRepository->findAll();
        $hotelsDTOs = HotelTransformer::transformToListOfDTOS($hotels);
        return $hotelsDTOs;
    }

    public function findHotelsByVille($ville){
        $hotels = $this->hotelRepository->findBy(["ville"=>$ville]);
        $hotelsDTOs = HotelTransformer::transformToListOfDTOS($hotels);
        return $hotelsDTOs;
    }

    public function findHotelsByPays($pays){
        $hotels = $this->hotelRepository->findBy(["pays"=>$pays]);
        $hotelsDTOs = HotelTransformer::transformToListOfDTOS($hotels);
        return $hotelsDTOs;
    }

    public function findAllCategoriesByHotel($id){
        $categories = $this->hotelRepository->findAllCategoriesByHotel($id);
        $categoriesDTOs = CategorieTransformer::transformToListOfDTOS($categories);
        return $categoriesDTOs;
    }

    public function findAllAvailableRoomsByCategorieFromHotel($id,$idCategorie,$dateDebut,$dateFin){
        $chambres = $this->hotelRepository->findAllAvailableRoomsByCategorieFromHotel($id,$idCategorie,$dateDebut,$dateFin);
        $chambresDTOs = ChambreTransformer::transformToListOfDTOS($chambres);
        return $chambresDTOs;
    }

    public function addNewHotel(HotelDTO $hotelDTO){
        if($hotelDTO == null){
            throw new Exception("Contenu de la requête Post est vide.");
        }
        $hotel = HotelTransformer::transformToEntity($hotelDTO);
        if ($hotel != null) {
            $this->hotelEntityManager->persist($hotel);
            $this->hotelEntityManager->flush();
        }
    }

    public function updateHotel(int $id, HotelDTO $newHotelDTO){
        $hotel = $this->hotelRepository->find($id);
        if($hotel == null){
            throw new Exception("Hotel avec l'id $id non trouvée. Pas possible de la mettre à jour");
        }
        $hotel = HotelTransformer::updateHotelEntityByNewHotelDTO($hotel, $newHotelDTO);
        
        try {
            $this->hotelEntityManager->persist($hotel);
            $this->hotelEntityManager->flush();
        } catch (QueryException $queryException){
            throw $queryException;
        }

    }
}