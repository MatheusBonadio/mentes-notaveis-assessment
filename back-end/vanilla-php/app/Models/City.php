<?php

namespace App\Models;

class City extends BaseModel
{
    protected string $table = 'cities';

    protected array $attributes = [
        'name', 'created_at', 'updated_at', 'state_id'
    ];
}
