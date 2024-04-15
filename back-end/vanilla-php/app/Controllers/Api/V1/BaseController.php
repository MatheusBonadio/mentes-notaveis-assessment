<?php

namespace App\Controllers;

use App\Traits\HttpResponse;

/**
 * Class BaseController
 * 
 * This class serves as the base controller for the API version 1.
 * It provides common functionality and methods that can be used by other controllers.
 */
class BaseController
{
    use HttpResponse;

    /**
     * Validates the incoming request.
     * 
     * @param mixed $request The request object.
     * @return void
     */
    protected function validateRequest($request)
    {
        $validation = $this->{$request}->validation();

        if (!empty($validation)) {
            $this->sendValidationError($validation);
            die();
        }
    }
}
