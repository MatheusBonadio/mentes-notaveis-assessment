<?php

namespace App\Controllers;

use App\Constants\HttpStatus;
use App\Models\Address;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Resources\AddressResource;

/**
 * Class AddressController
 * 
 * This class handles the API endpoints related to addresses.
 */
class AddressController extends BaseController
{
    private Address $address;
    private City $city;
    private State $state;
    private User $user;

    /**
     * AddressController constructor.
     * 
     * Initializes a new instance of the AddressController class.
     */
    public function __construct()
    {
        $this->address = new Address();
        $this->city = new City();
        $this->state = new State();
        $this->user = new User();
    }

    /**
     * Get all addresses.
     * 
     * @return Response
     */
    public function index()
    {
        $addresses = $this->address->all();

        return $this->sendSuccess((new AddressResource())->collection($addresses));
    }

    /**
     * Get a specific address by ID.
     * 
     * @param string $id The ID of the address to retrieve.
     * @return Response
     */
    public function show(string $id)
    {
        $address = $this->address->find(['id' => $id]);

        if (!$address)
            return $this->sendError('Record not found', HttpStatus::NOT_FOUND);

        $address->user = $this->user->find(['id' => $address->user_id]);
        $address->city = $this->city->find(['id' => $address->city_id]);
        $address->city->state = $this->state->find(['id' => $address->city->state_id]);

        return $this->sendSuccess((new AddressResource())->resource($address));
    }
}
