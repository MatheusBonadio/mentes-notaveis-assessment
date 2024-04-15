<?php

namespace App\Traits;

use App\Constants\HttpStatus;

trait HttpResponse
{
    /**
     * Send Success API Response
     *
     * @param $data
     * @param string $message
     * @param int $status
     * @return void
     */
    public function sendSuccess($data, int $status = HttpStatus::OK)
    {
        $this->headers($status);
        echo json_encode($data);
    }

    /**
     * Send Failed API Response
     *
     * @param string $message
     * @param int $status
     * @param array|null $data
     */
    public function sendError(string $message = 'Record not found', int $status = HttpStatus::BAD_REQUEST)
    {
        $this->headers($status);

        echo json_encode(array(
            'message' => $message,
            'status' => $status,
        ));
    }

    /**
     * Send Validation Failed API Response
     *
     * @param array|null $data
     */
    public function sendValidationError(array $data = [])
    {
        $status = HttpStatus::UNPROCESSABLE_ENTITY;

        $this->headers($status);

        echo json_encode(array(
            'message' => 'Data invalid',
            'status' => $status,
            'errors' => $data,
        ));
    }


    private function headers($status)
    {
        // clear the old headers
        header_remove();
        // set the actual code
        http_response_code($status);
        // set the header to make sure cache is forced
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        // treat this as json
        header('Content-Type: application/json');
        // validation error, or failure
        header('Status: ' . HttpStatus::getLabel($status));
    }
}
