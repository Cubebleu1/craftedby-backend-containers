<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     *  Display a list of users (needs admin rights).
     *
     * @OA\Get(
     *     path="/users",
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(Request $request): ResourceCollection
    {
        //Authorize user(admin) with policy method
        $this->authorize('viewAny', User::class);

        //Pass the user param to request
        $request->merge(['user' => true]);

        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     *  Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/users",
     *     summary="Register a new user",
     *     tags={"Users"},
     *     security={ {"sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Unexpected error",
     *     )
     * )
     */
    public function store(StoreUserRequest $request)
    {
        //Pass the user param to request
        $request->merge(['user' => true]);

        $validatedData = $request->validated();

        //Create User
        $user = User::create($validatedData);

        // Retrieve the regular_user role
        $regularUserRole = Role::where('name', 'regular_user')->first();

        // Check if the regular_user role exists and attach it to the user
        if ($regularUserRole) {
            $user->roles()->attach($regularUserRole->id);
        }

        return response()->json([
            'message' => 'User successfully registered',
            'created user' => $user,
        ], 201);
    }

    /**
     *
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Display a specific user",
     *     tags={"Users"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Successful operation", @OA\JsonContent(ref="#/components/schemas/User")),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function show(Request $request, string $id): UserResource
    {
        //Pass the product param to request
        $request->merge(['user' => true]);
        $request->merge(['single_user' => true]);

        $user = User::findOrFail($id);

        // Authorize user to view if looking at own user data
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="Update an existing user",
     *     tags={"Users"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(response=200, description="User updated successfully"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        //Authorize user with policy method
        $this->authorize('update', $user);

        $validatedData = $request->validated();

        // Check which fields have been provided in the request and update only those fields
        if (isset($validatedData['first_name'])) {
            $user->first_name = $validatedData['first_name'];
        }
        if (isset($validatedData['last_name'])) {
            $user->last_name = $validatedData['last_name'];
        }
        if (isset($validatedData['address'])) {
            $user->address = $validatedData['address'];
        }
        if (isset($validatedData['postal_code'])) {
            $user->postal_code = $validatedData['postal_code'];
        }
        if (isset($validatedData['city'])) {
            $user->city = $validatedData['city'];
        }
        if (isset($validatedData['phone_number'])) {
            $user->phone_number = $validatedData['phone_number'];
        }
        if (isset($validatedData['email'])) {
            $user->email = $validatedData['email'];
        }
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="Delete a user",
     *     tags={"Users"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="User deleted successfully"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        //Authorize user with policy method
        $this->authorize('delete', $user);

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}
