<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\City;

class CityController extends Controller
{
    /**
     * @OA\Get(
     *    path="/api/v1/cities",
     *    summary="Get all cities",
     *    tags={"City"},
     *    @OA\Response(
     *        response=200,
     *        description="Successful operation"
     *    )
     * )
     */
    public function index()
    {
        return City::all();
    }

    /**
     * @OA\Get(
     *    path="/api/v1/cities/{id}",
     *    summary="Get a specific city",
     *    tags={"City"},
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="ID of the city",
     *        required=true,
     *        @OA\Schema(
     *            type="string"
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="Successful operation"
     *    ),
     *    @OA\Response(
     *        response=404,
     *        description="Record not found"
     *    )
     * )
     */
    public function show(City $city)
    {
        return City::with('state')->find($city->id);
    }
}
