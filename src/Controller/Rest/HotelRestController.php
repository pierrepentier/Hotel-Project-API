<?php

namespace App\Controller\Rest;

use App\DTO\HotelDTO;
use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Service\HotelService;
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


class HotelRestController extends AbstractFOSRestController {

    private $hotelRepository;
    private $hotelEntityManager;
    private $hotelService;

    const ALL_HOTELS_URI = "/hotels";
    const SINGLE_HOTEL_URI = "/hotels/{id}";
    const HOTELS_BY_VILLE_URI = "/hotels/ville/{ville}"; 
    const HOTELS_BY_PAYS_URI = "/hotels/pays/{pays}"; 
    const ALL_CATEGORIES_BY_HOTEL_URI = "/hotels/{id}/categories";
    const ALL_AVAILABLE_ROOMS_BY_DATES_URI = "/hotels/{id}/categories/{idCategorie}/{dateDebut}/{dateFin}";

    public function __construct(HotelService $hotelService, EntityManagerInterface $manager, HotelRepository $hotelRepository)
    {
        $this->hotelService = $hotelService;
        $this->hotelRepository = $hotelRepository;
        $this->hotelEntityManager = $manager;
    }

    /**
     * Look for all hotels in database
     * @Get(HotelRestController::ALL_HOTELS_URI)
     * @param HotelRepository $hotelRepository
     * @return Response
     */
    public function findAllHotels(){
        $hotels = $this->hotelService->findAllHotels();
        if(empty($hotels)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($hotels, Response::HTTP_OK);
    }

    /**
     * Look for hotels by ville in database
     * @Get(HotelRestController::HOTELS_BY_VILLE_URI)
     * @param HotelRepository $hotelRepository
     * @return Response
     */
    public function findHotelsByVille($ville){
        $hotels = $this->hotelService->findHotelsByVille($ville);
        if(empty($hotels)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($hotels, Response::HTTP_OK);
    }

    /**
     * Look for hotels by ville in database
     * @Get(HotelRestController::HOTELS_BY_PAYS_URI)
     * @param HotelRepository $hotelRepository
     * @return Response
     */
    public function findHotelsByPays($pays){
        $hotels = $this->hotelService->findHotelsByPays($pays);
        if(empty($hotels)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($hotels, Response::HTTP_OK);
    }

    /**
     * Look for all categories by hotel in database
     * @Get(HotelRestController::ALL_CATEGORIES_BY_HOTEL_URI)
     * @param HotelRepository $hotelRepository
     * @return Response
     */
    public function findAllCategoriesByHotel($id){
        $categories = $this->hotelService->findAllCategoriesByHotel($id);
        if(empty($categories)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($categories, Response::HTTP_OK);
    
    
    }
    /**
     * Look for Available rooms by categorie in database
     * @Get(HotelRestController::ALL_AVAILABLE_ROOMS_BY_DATES_URI)
     * @param HotelRepository $hotelRepository
     * @return Response
     */
    public function findAllAvailableRoomsByCategorieFromHotel($id,$idCategorie,$dateDebut,$dateFin){
        $chambres = $this->hotelService->findAllAvailableRoomsByCategorieFromHotel($id,$idCategorie,$dateDebut,$dateFin);
        if(empty($chambres)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($chambres, Response::HTTP_OK);
    }



    /**
     * Create a new hotel in database
     * @POST(HotelRestController::ALL_HOTELS_URI)
     * @ParamConverter("hotelDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function createHotel(HotelDTO $hotelDTO){
        try{
            $this->hotelService->addNewHotel($hotelDTO);
        } catch (Exception $exception){
            return View::create($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
        return View::create(null, Response::HTTP_CREATED);
    }

    /**
     * Modifies a hotel in database
     * @Put(HotelRestController::SINGLE_HOTEL_URI)
     * @ParamConverter("hotelDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param Hotel $hotel
     * @param EntityManagerInterface $manager
     * @return void
     */
    public function updateHotel(HotelDTO $hotelDTO, int $id){
        try {
            $this->hotelService->updateHotel($id, $hotelDTO);
        } catch (QueryException $queryException){
            return View::create("Echec lors de la mise à jour pour l'hôtel avec id $id", Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $exception){
            return View::create($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}