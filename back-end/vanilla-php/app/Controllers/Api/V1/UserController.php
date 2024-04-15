<?php

namespace App\Controllers;

use App\Constants\HttpStatus;
use App\Models\User;
use App\Requests\StoreUserRequest;
use App\Requests\UpdateUserRequest;
use App\Resources\UserResource;

/**
 * Class UserController
 * 
 * This class represents the controller for managing user-related operations in the API.
 * It extends the BaseController class.
 */
class UserController extends BaseController
{
    private User $user;

    protected StoreUserRequest $storeUserRequest;
    protected UpdateUserRequest $updateUserRequest;

    /**
     * UserController constructor.
     * 
     * Initializes the UserController class by creating instances of the User model and the request objects.
     */
    public function __construct()
    {
        $this->user = new User();
        $this->storeUserRequest = new StoreUserRequest();
        $this->updateUserRequest = new UpdateUserRequest();
    }

    /**
     * Retrieves all users.
     * 
     * @return Response The response object containing the list of users.
     */
    public function index()
    {
        $users = $this->user->all();

        return $this->sendSuccess((new UserResource())->collection($users));
    }

    /**
     * Stores a new user.
     * 
     * @return Response The response object indicating the success or failure of the operation.
     */
    public function store()
    {
        $this->validateRequest('storeUserRequest');
        $request = $this->storeUserRequest->modifiedData();

        try {
            $created = $this->user->create($request);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), HttpStatus::BAD_REQUEST);
        }

        return $this->sendSuccess([
            'message' => 'User created successfully',
            'status' => HttpStatus::OK,
            'data' => (new UserResource())->resource((object) $request)
        ]);
    }

    /**
     * Retrieves a specific user by ID.
     * 
     * @param string $id The ID of the user to retrieve.
     * @return Response The response object containing the user data or an error message if the user is not found.
     */
    public function show(string $id)
    {
        $user = $this->user->find(['id' => $id]);

        if (!$user)
            return $this->sendError('Record not found', HttpStatus::NOT_FOUND);

        return $this->sendSuccess((new UserResource())->resource($user));
    }

    /**
     * Updates a specific user by ID.
     * 
     * @param string $id The ID of the user to update.
     * @return Response The response object indicating the success or failure of the operation.
     */
    public function update(string $id)
    {
        $user = $this->user->find(['id' => $id]);

        if (!$user)
            return $this->sendError('Record not found', HttpStatus::NOT_FOUND);

        $this->validateRequest('updateUserRequest');
        $request = $this->updateUserRequest->modifiedData();

        try {
            $updated = $this->user->update(['id' => $id], $request);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), HttpStatus::BAD_REQUEST);
        }

        $user->name = $request['name'];
        $user->email = $request['email'];

        return $this->sendSuccess([
            'message' => 'User updated successfully',
            'status' => HttpStatus::OK,
            'data' => (new UserResource())->resource($user)
        ]);
    }

    /**
     * Deletes a specific user by ID.
     * 
     * @param string $id The ID of the user to delete.
     * @return Response The response object indicating the success or failure of the operation.
     */
    public function destroy(string $id)
    {
        $user = $this->user->find(['id' => $id]);

        if (!$user)
            return $this->sendError('Record not found', HttpStatus::NOT_FOUND);

        try {
            $deleted = $this->user->delete(['id' => $id]);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), HttpStatus::BAD_REQUEST);
        }

        return $this->sendSuccess([
            'message' => 'User deleted successfully',
            'status' => HttpStatus::OK
        ]);
    }
}
