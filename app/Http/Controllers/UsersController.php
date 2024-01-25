<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        //Authorize user(admin) with policy method
        $this->authorize('viewAny', User::class);

        return response()->json([
            'message' => 'List of users',
            'users' => $users,
        ]);
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        //Authorize user with policy method
        $this->authorize('view', $user);

        return response()->json([
            'message' => 'Selected user',
            'user' => $user,
        ]);
    }

//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit(string $id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        //Authorize user with policy method
        $this->authorize('view', $user);

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
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
        ]);
    }
}
