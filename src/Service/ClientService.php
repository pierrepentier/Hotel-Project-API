<?php

namespace App\Service;

use App\DTO\ClientDTO;
use App\Repository\ClientRepository;
use App\Transformer\ClientTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;

class ClientService {

    private $clientRepository;
    private $clientEntityManager;

    public function __construct(EntityManagerInterface $manager, ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->clientEntityManager = $manager;
    }

    public function findAllClients(){
        $clients = $this->clientRepository->findAll();
        $clientsDTOs = ClientTransformer::transformToListOfDTOS($clients);
        return $clientsDTOs;
    }

    public function addNewClient(ClientDTO $clientDTO){
        if($clientDTO == null){
            throw new Exception("Contenu de la requête Post est vide.");
        }
        $client = ClientTransformer::transformToEntity($clientDTO);
        if ($client != null) {
            $this->clientEntityManager->persist($client);
            $this->clientEntityManager->flush();
        }
    }

    public function updateClient(int $id, ClientDTO $newClientDTO){
        $client = $this->clientRepository->find($id);
        if($client == null){
            throw new Exception("Client avec l'id $id non trouvée. Pas possible de la mettre à jour");
        }
        $client = ClientTransformer::updateClientEntityByNewClientDTO($client, $newClientDTO);
        
        try {
            $this->clientEntityManager->persist($client);
            $this->clientEntityManager->flush();
        } catch (QueryException $queryException){
            throw $queryException;
        }

    }
}