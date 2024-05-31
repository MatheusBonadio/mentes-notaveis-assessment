<?php

namespace App\Resources;

class StateResource extends BaseResource
{
    /**
     * Formats a resource into an array.
     *
     * @param mixed $resource The resource to be formatted.
     * @return array The formatted resource as an array.
     */
    protected function formatResource($resource): array
    {
        $state = [
            'id' => $resource->id,
            'name' => $resource->name
        ];

        if (isset($resource->cities))
            $state['cities'] = (new CityResource())->collection($resource->cities);

        return $state;
    }
}
