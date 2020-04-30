<?php

namespace App\Controller\Rest;

use App\DTO\TariferDTO;
use App\Entity\Tarifer;
use App\Repository\TariferRepository;
use App\Service\TariferService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TariferRestController extends AbstractFOSRestController {

    private $tariferRepository;
    private $tariferEntityManager;
    private $tariferService;

    const ALL_TARIFERS_URI = "/tarifers";
    const SINGLE_TARIFER_URI = "/tarifers/{id}"; 

    public function __construct(TariferService $tariferService, EntityManagerInterface $manager, TariferRepository $tariferRepository)
    {
        $this->tariferService = $tariferService;
        $this->tariferRepository = $tariferRepository;
        $this->tariferEntityManager = $manager;
    }

    /**
     * Look for all tarifers in database
     * @Get(TariferRestController::ALL_TARIFERS_URI)
     * @param TariferRepository $tariferRepository
     * @return Response
     */
    public function findAllTarifers(){
        $tarifers = $this->tariferService->findAllTarifers();
        if(empty($tarifers)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($tarifers, Response::HTTP_OK);
    }

    /**
     * Create a new tarifer in database
     * @POST(TariferRestController::ALL_TARIFERS_URI)
     * @ParamConverter("tariferDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function createTarifer(TariferDTO $tariferDTO){
        try{
            $this->tariferService->addNewTarifer($tariferDTO);
        } catch (Exception $exception){
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
        return View::create(null, Response::HTTP_CREATED);
    }

    /**
     * Modifies a tarifer in database
     * @Put(TariferRestController::SINGLE_TARIFER_URI)
     * @ParamConverter("tariferDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param Tarifer $tarifer
     * @param EntityManagerInterface $manager
     * @return void
     */
    public function updateTarifer(TariferDTO $tariferDTO, int $id){
        try {
            $this->tariferService->updateTarifer($id, $tariferDTO);
        } catch (QueryException $queryException){
            return View::create("Echec lors de la mise à jour pour le tarif avec id $id", Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $exception){
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}