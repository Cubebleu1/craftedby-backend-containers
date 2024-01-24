<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
//logic already in userController
//    public function register(Request $request){
//        $registerUserData = $request->validate([
//            'name'=>'required|string',
//            'email'=>'required|string|email|unique:users',
//            'password'=>'required|min:8'
//        ]);
//        $user = User::create([
//            'name' => $registerUserData['name'],
//            'email' => $registerUserData['email'],
//            'password' => Hash::make($registerUserData['password']),
//        ]);
//        return response()->json([
//            'message' => 'User Created ',
//        ]);
//    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            //no session for API
//            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
