<?php

namespace App\Requests;

class StoreUserRequest extends BaseRequest
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
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    /**
     * Get the modified data for the request.
     *
     * @return array The modified data.
     */
    public function modifiedData(): array
    {
        $request = $this->getBody();

        $request['id'] = "";
        $request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
        $request['email_verified_at'] = null;
        $request['created_at'] = date('Y-m-d H:i:s');
        $request['updated_at'] = date('Y-m-d H:i:s');

        return $request;
    }
}
