<?php

namespace App\Models;

class Address extends BaseModel
{
    protected string $table = 'addresses';

    protected array $attributes = [
        'name', 'street', 'updated_at', 'user_id', 'city_id'
    ];
}
