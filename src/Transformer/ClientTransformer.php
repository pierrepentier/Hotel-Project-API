<?php

namespace App\Transformer;

use App\Entity\Client;
use App\DTO\ClientDTO;


class ClientTransformer
{
 
    public static function transformToDTO(Client $client){
        if($client == null) {
            return null;
        }
        $clientDTO = (new ClientDTO)->setNom($client->getNom())
                                    ->setPrenom($client->getPrenom())
                                    ->setEmail($client->getEmail())
                                    ->setTelephone($client->getTelephone())
                                    ->setNumeroAdresse($client->getNumeroAdresse())
                                    ->setNomAdresse($client->getNomAdresse())
                                    ->setVille($client->getVille())
                                    ->setCodePostal($client->getCodepostal())
                                    ->setPays($client->getPays());

                                         

        return $clientDTO;
    }

    public static function transformToEntity(ClientDTO $clientDTO){
        if($clientDTO == null) {
            return null;
        }
        $client = (new Client)->setNom($clientDTO->getNom())
                              ->setPrenom($clientDTO->getPrenom())
                              ->setEmail($clientDTO->getEmail())
                              ->setTelephone($clientDTO->getTelephone())
                              ->setNumeroAdresse($clientDTO->getNumeroAdresse())
                              ->setNomAdresse($clientDTO->getNomAdresse())
                              ->setVille($clientDTO->getVille())
                              ->setCodePostal($clientDTO->getCodepostal())
                              ->setPays($clientDTO->getPays());
                                         

        return $client;
    }

    public static function transformToListOfDTOS(array $clients){
        $clientsDTos = [];
        foreach ($clients as $client) {
            $clientsDTos[] = self::transformToDTO($client);
        }
        return $clientsDTos;
    }

    public static function updateClientEntityByNewClientDTO(Client $client, ClientDTO $newClientDTO){
        $client->setNom($newClientDTO->getNom())
                ->setPrenom($newClientDTO->getPrenom())
                ->setEmail($newClientDTO->getEmail())
                ->setTelephone($newClientDTO->getTelephone())
                ->setNumeroAdresse($newClientDTO->getNumeroAdresse())
                ->setNomAdresse($newClientDTO->getNomAdresse())
                ->setVille($newClientDTO->getVille())
                ->setCodePostal($newClientDTO->getCodepostal())
                ->setPays($newClientDTO->getPays());
                   

        return $client;

    }

}