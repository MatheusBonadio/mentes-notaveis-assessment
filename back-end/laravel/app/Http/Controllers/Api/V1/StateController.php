<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\State;

class StateController extends Controller
{
    /**
     * @OA\Get(
     *    path="/api/v1/states",
     *    summary="Get all states",
     *    tags={"State"},
     *    @OA\Response(
     *        response=200,
     *        description="Successful operation"
     *    )
     * )
     */
    public function index()
    {
        return State::all();
    }

    /**
     * @OA\Get(
     *    path="/api/v1/states/{id}",
     *    summary="Get a specific state",
     *    tags={"State"},
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="ID of the state",
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
    public function show(State $state)
    {
        return State::with('cities')->find($state->id);
    }
}
