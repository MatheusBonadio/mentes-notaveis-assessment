<?php

namespace App\Resources;

class UserResource extends BaseResource
{
    /**
     * Format the given resource into an array.
     *
     * @param mixed $resource The resource to be formatted.
     * @return array The formatted resource as an array.
     */
    protected function formatResource($resource): array
    {
        $user = [
            'id' => $resource->id,
            'name' => $resource->name,
            'email' => $resource->email,
            'email_verified_at' => $resource->email_verified_at
        ];

        if (isset($resource->addresses))
            $user['addresses'] = (new AddressResource())->collection($resource->addresses);

        return $user;
    }
}
