<?php

namespace App\Resources;

class AddressResource extends BaseResource
{
    /**
     * Format the given resource into an array.
     *
     * @param mixed $resource The resource to be formatted.
     * @return array The formatted resource as an array.
     */
    protected function formatResource($resource): array
    {
        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'street' => $resource->street,
            'user_id' => $resource->user_id,
            'city_id' => $resource->city_id
        ];
    }
}
