<?php

namespace App\Controllers;

use App\Constants\HttpStatus;
use App\Models\State;
use App\Resources\StateResource;

/**
 * Class StateController
 * 
 * This class represents the controller for managing states in the API.
 * It extends the BaseController class.
 */
class StateController extends BaseController
{
    private State $state;

    /**
     * StateController constructor.
     * 
     * Initializes a new instance of the StateController class.
     * It creates a new State object.
     */
    public function __construct()
    {
        $this->state = new State();
    }

    /**
     * Get all states.
     * 
     * Retrieves all states from the database.
     * 
     * @return Response The response containing the list of states.
     */
    public function index()
    {
        $states = $this->state->all();

        return $this->sendSuccess((new StateResource())->collection($states));
    }

    /**
     * Get a specific state by ID.
     * 
     * Retrieves a specific state from the database based on the provided ID.
     * 
     * @param string $id The ID of the state to retrieve.
     * @return Response The response containing the state resource if found, or an error message if not found.
     */
    public function show(string $id)
    {
        $state = $this->state->find(['id' => $id]);

        if (!$state)
            return $this->sendError('Record not found', HttpStatus::NOT_FOUND);

        return $this->sendSuccess((new StateResource())->resource($state));
    }
}
