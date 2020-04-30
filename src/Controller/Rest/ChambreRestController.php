<?php

namespace App\Controller\Rest;

use App\DTO\ChambreDTO;
use App\Entity\Chambre;
use App\Repository\ChambreRepository;
use App\Service\ChambreService;
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


class ChambreRestController extends AbstractFOSRestController {

    private $chambreRepository;
    private $chambreEntityManager;
    private $chambreService;

    const ALL_CHAMBRES_URI = "/chambres";
    const SINGLE_CHAMBRE_URI = "/chambres/{id}"; 

    public function __construct(ChambreService $chambreService, EntityManagerInterface $manager, ChambreRepository $chambreRepository)
    {
        $this->chambreService = $chambreService;
        $this->chambreRepository = $chambreRepository;
        $this->chambreEntityManager = $manager;
    }

    /**
     * Look for all chambres in database
     * @Get(ChambreRestController::ALL_CHAMBRES_URI)
     * @param ChambreRepository $chambreRepository
     * @return Response
     */
    public function findAllChambres(){
        $chambres = $this->chambreService->findAllChambres();
        if(empty($chambres)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($chambres, Response::HTTP_OK);
    }

    /**
     * Create a new chambre in database
     * @POST(ChambreRestController::ALL_CHAMBRES_URI)
     * @ParamConverter("chambreDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function createChambre(ChambreDTO $chambreDTO){
        try{
            $this->chambreService->addNewChambre($chambreDTO);
        } catch (Exception $exception){
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
        return View::create(null, Response::HTTP_CREATED);
    }

    /**
     * Modifies a chambre in database
     * @Put(ChambreRestController::SINGLE_CHAMBRE_URI)
     * @ParamConverter("chambreDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param Chambre $chambre
     * @param EntityManagerInterface $manager
     * @return void
     */
    public function updateChambre(ChambreDTO $chambreDTO, int $id){
        try {
            $this->chambreService->updateChambre($id, $chambreDTO);
        } catch (QueryException $queryException){
            return View::create("Echec lors de la mise à jour pour la chambre avec id $id", Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $exception){
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}