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
        $address = [
            'id' => $resource->id,
            'name' => $resource->name,
            'street' => $resource->street,
            'user_id' => $resource->user_id,
            'city_id' => $resource->city_id
        ];

        if (isset($resource->user))
            $address['user'] = (new UserResource())->resource($resource->user);

        if (isset($resource->city))
            $address['city'] = (new CityResource())->resource($resource->city);

        return $address;
    }
}
