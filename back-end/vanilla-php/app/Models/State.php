<?php

namespace App\Models;

class State extends BaseModel
{
    protected string $table = 'states';

    protected array $attributes = [
        'name', 'created_at', 'updated_at'
    ];
}
