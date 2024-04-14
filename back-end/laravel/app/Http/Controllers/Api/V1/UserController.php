<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * @OA\Get(
     *    path="/api/v1/users",
     *    summary="Get all users",
     *    tags={"User"},
     *    @OA\Response(
     *        response=200,
     *        description="Successful operation",
     *    )
     * )
     */
    public function index()
    {
        return User::all();
    }

    /**
     * @OA\Post(
     *    path="/api/v1/users",
     *    summary="Create a new user",
     *    tags={"User"},
     *    security={{"sanctum":{}}},
     *    @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *            @OA\Property(property="name", type="string", example="name"),
     *            @OA\Property(property="email", type="string", example="email@email.com"),
     *            @OA\Property(property="password", type="string", example="password")
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="User created successfully"
     *    ),
     *    @OA\Response(
     *        response=422,
     *        description="Data invalid"
     *    ),
     *    @OA\Response(
     *        response=400,
     *        description="Something went wrong"
     *    ),
     *    @OA\Response(
     *        response=401,
     *        description="Unauthorized"
     *    )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails())
            return $this->error('Data invalid', 422, $validator->errors());

        $created = User::create([
            'name' => $validator->validated()['name'],
            'email' => $validator->validated()['email'],
            'password' => bcrypt($validator->validated()['password'])
        ]);

        if (!$created)
            return $this->error('Something went wrong', 400);

        return $this->response('User created successfully', 200, $created);
    }

    /**
     * @OA\Get(
     *    path="/api/v1/users/{id}",
     *    summary="Get a specific user",
     *    tags={"User"},
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="ID of the user",
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
    public function show(User $user)
    {
        return User::with('addresses.city.state')->find($user->id);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/users/{id}",
     *     tags={"User"},
     *     security={{"sanctum":{}}},
     *     summary="Update a user",
     *     description="Update the details of a user.",
     *     @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="ID of the user",
     *        required=true,
     *        @OA\Schema(
     *            type="string"
     *        )
     *    ),
     *    @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *            @OA\Property(property="name", type="string", example="name"),
     *            @OA\Property(property="email", type="string", example="email@email.com")
     *        )
     *    ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Data invalid"
     *     ),
     *     @OA\Response(
     *        response=400,
     *        description="Something went wrong"
     *    ),
     *    @OA\Response(
     *        response=401,
     *        description="Unauthorized"
     *    )
     * )
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        if ($validator->fails())
            return $this->error('Data invalid', 422, $validator->errors());

        $updated = $user->update([
            'name' => $validator->validated()['name'],
            'email' => $validator->validated()['email']
        ]);

        if (!$updated)
            return $this->error('Something went wrong', 400);

        return $this->response('User updated successfully', 200, $user);
    }


    /**
     * @OA\Delete(
     *    path="/api/v1/users/{id}",
     *    summary="Delete a user",
     *    tags={"User"},
     *    security={{"sanctum":{}}},
     *    @OA\Parameter(
     *        name="id",
     *        in="path",
     *        description="ID of the user",
     *        required=true,
     *        @OA\Schema(
     *            type="string"
     *        )
     *    ),
     *    @OA\Response(
     *        response=200,
     *        description="User deleted successfully"
     *    ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found"
     *     ),
     *    @OA\Response(
     *        response=400,
     *        description="Something went wrong"
     *    ),
     *    @OA\Response(
     *        response=401,
     *        description="Unauthorized"
     *    )
     * )
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();

        if (!$deleted)
            return $this->error('Something went wrong', 400);

        return $this->response('User deleted successfully', 200);
    }
}
