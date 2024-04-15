<?php

namespace App\Exceptions;

use App\Constants\HttpStatus;
use Exception;

class NotFoundException extends Exception
{
    /**
     * NotFoundException class.
     *
     * This class represents an exception that is thrown when a route is not found.
     */
    public function __construct()
    {
        echo json_encode(array(
            'message' => 'Route not found',
            'status' => HttpStatus::NOT_FOUND,
        ));
    }
}
