<?php

namespace App\Controllers;

use App\Constants\HttpStatus;
use App\Models\City;
use App\Models\State;
use App\Resources\CityResource;

/**
 * Class CityController
 * 
 * This class is responsible for handling API requests related to cities.
 */
class CityController extends BaseController
{
    private City $city;
    private State $state;

    /**
     * CityController constructor.
     * 
     * Initializes a new instance of the CityController class.
     */
    public function __construct()
    {
        $this->city = new City();
        $this->state = new State();
    }

    /**
     * Get all cities.
     * 
     * @return Response
     */
    public function index()
    {
        $cities = $this->city->all();

        return $this->sendSuccess((new CityResource())->collection($cities));
    }

    /**
     * Get a specific city by ID.
     * 
     * @param string $id The ID of the city to retrieve.
     * @return Response
     */
    public function show(string $id)
    {
        $city = $this->city->find(['id' => $id]);

        if (!$city)
            return $this->sendError('Record not found', HttpStatus::NOT_FOUND);

        $city->state = $this->state->find(['id' => $city->state_id]);

        return $this->sendSuccess((new CityResource())->resource($city));
    }
}
