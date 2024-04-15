<?php

namespace App\Controllers;

use App\Constants\HttpStatus;
use App\Models\Address;
use App\Resources\AddressResource;

/**
 * Class AddressController
 * 
 * This class handles the API endpoints related to addresses.
 */
class AddressController extends BaseController
{
    private Address $address;

    /**
     * AddressController constructor.
     * 
     * Initializes a new instance of the AddressController class.
     */
    public function __construct()
    {
        $this->address = new Address();
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

        return $this->sendSuccess((new AddressResource())->resource($address));
    }
}
