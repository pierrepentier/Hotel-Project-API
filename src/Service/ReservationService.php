<?php

namespace App\Service;

use App\DTO\ReservationDTO;
use App\Repository\ReservationRepository;
use App\Transformer\ReservationTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;

class ReservationService {

    private $reservationRepository;
    private $reservationEntityManager;

    public function __construct(EntityManagerInterface $manager, ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->reservationEntityManager = $manager;
    }

    public function findAllReservations(){
        $reservations = $this->reservationRepository->findAll();
        $reservationsDTOs = ReservationTransformer::transformToListOfDTOS($reservations);
        return $reservationsDTOs;
    }

    public function addNewReservation(ReservationDTO $reservationDTO){
        if($reservationDTO == null){
            throw new Exception("Contenu de la requête Post est vide.");
        }
        $reservation = ReservationTransformer::transformToEntity($reservationDTO);
        if ($reservation != null) {
            $this->reservationEntityManager->persist($reservation);
            $this->reservationEntityManager->flush();
        }
    }

    public function updateReservation(int $id, ReservationDTO $newReservationDTO){
        $reservation = $this->reservationRepository->find($id);
        if($reservation == null){
            throw new Exception("Reservation avec l'id $id non trouvée. Pas possible de la mettre à jour");
        }
        $reservation = ReservationTransformer::updateReservationEntityByNewReservationDTO($reservation, $newReservationDTO);
        
        try {
            $this->reservationEntityManager->persist($reservation);
            $this->reservationEntityManager->flush();
        } catch (QueryException $queryException){
            throw $queryException;
        }

    }
}