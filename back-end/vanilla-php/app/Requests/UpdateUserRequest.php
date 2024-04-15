<?php

namespace App\Requests;

class UpdateUserRequest extends BaseRequest
{
    /**
     * Get the validation rules for the request.
     *
     * @return array The validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL]
        ];
    }

    /**
     * Get the modified data from the request.
     *
     * @return array The modified data.
     */
    public function modifiedData(): array
    {
        $request = $this->getBody();

        $request['updated_at'] = date('Y-m-d H:i:s');

        return $request;
    }
}
