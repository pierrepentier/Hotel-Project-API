<?php

namespace App\Transformer;

use App\Entity\Reservation;
use App\DTO\ReservationDTO;


class ReservationTransformer
{
 
    public static function transformToDTO(Reservation $reservation){
        if($reservation == null) {
            return null;
        }
        $reservationDTO = (new ReservationDTO)->setDateDebut($reservation->getDateDebut())
                                              ->setDateFin($reservation->getDateFin())
                                              ->setNbrNuitees($reservation->getNbrNuitees())
                                              ->setPrixTotal($reservation->getPrixTotal())
                                              ->setClientDTO(ClientTransformer::transformToDTO($reservation->getClient()))
                                              ->setChambreDTO(ChambreTransformer::transformToDTO($reservation->getChambre()));
                                         

        return $reservationDTO;
    }

    public static function transformToEntity(ReservationDTO $reservationDTO){
        if($reservationDTO == null) {
            return null;
        }
        $reservation = (new Reservation)->setDateDebut($reservationDTO->getDateDebut())
                                        ->setDateFin($reservationDTO->getDateFin())
                                        ->setNbrNuitees($reservationDTO->getNbrNuitees())
                                        ->setPrixTotal($reservationDTO->getPrixTotal())
                                        ->setClient(ClientTransformer::transformToEntity($reservationDTO->getClientDTO()))
                                        ->setChambre(ChambreTransformer::transformToEntity($reservationDTO->getChambreDTO()));
                                         

        return $reservation;
    }

    public static function transformToListOfDTOS(array $reservations){
        $reservationsDTos = [];
        foreach ($reservations as $reservation) {
            $reservationsDTos[] = self::transformToDTO($reservation);
        }
        return $reservationsDTos;
    }

    public static function updateReservationEntityByNewReservationDTO(Reservation $reservation, ReservationDTO $newReservationDTO){

        $reservation->setDateDebut($newReservationDTO->getDateDebut())
                    ->setDateFin($newReservationDTO->getDateFin())
                    ->setNbrNuitees($newReservationDTO->getNbrNuitees())
                    ->setPrixTotal($newReservationDTO->getPrixTotal())
                    ->setClient(ClientTransformer::transformToEntity($newReservationDTO->getClientDTO()))
                    ->setChambre(ChambreTransformer::transformToEntity($newReservationDTO->getChambreDTO()));
         

        return $reservation;
    }


}