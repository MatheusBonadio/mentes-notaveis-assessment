<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * @OA\Get(
     *    path="/api/v1/addresses",
     *    summary="Get all addresses",
     *    tags={"Address"},
     *    @OA\Response(
     *        response=200,
     *        description="Successful operation"
     *    )
     * )
     */
    public function index()
    {
        return Address::all();
    }

    /**
     * @OA\Get(
     *    path="/api/v1/addresses/{id}",
     *    summary="Get a specific address",
     *    tags={"Address"},
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="ID of the address",
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
    public function show(Address $address)
    {
        return Address::with('user', 'city.state')->find($address->id);
    }
}
