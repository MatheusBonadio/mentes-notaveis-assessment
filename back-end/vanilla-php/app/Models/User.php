<?php

namespace App\Models;

class User extends BaseModel
{
    protected string $table = 'users';

    protected array $attributes = [
        'name', 'email', 'email_verified_at', 'password', 'created_at', 'updated_at'
    ];
}
