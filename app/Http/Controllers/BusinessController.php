<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::all();
        return response()->json($businesses);
    }

    public function show($id)
    {
        $business = Business::find($id);
        if (!$business) {
            return response()->json(['message' => 'Business not found'], 404);
        }
        return response()->json($business);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|uuid',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
//            'siret' => 'required|numeric|digits:14',
            'craft_id' => 'required|uuid',
            'website' => 'nullable|url|max:255',
            'biography' => 'nullable|string',
            'history' => 'nullable|string',
            'theme_id' => 'required|uuid',
        ]);

        $business = Business::create($validatedData);
        return response()->json($business, 201);
    }

    public function update(Request $request, $id)
    {
        $business = Business::find($id);
        if (!$business) {
            return response()->json(['message' => 'Business not found'], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'sometimes|uuid',
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'postal_code' => 'sometimes|string|max:10',
            'city' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone_number' => 'sometimes|string|max:20',
//            'siret' => 'sometimes|numeric|digits:14',
            'craft_id' => 'sometimes|uuid',
            'website' => 'sometimes|nullable|url|max:255',
            'biography' => 'sometimes|nullable|string',
            'history' => 'sometimes|nullable|string',
            'theme_id' => 'sometimes|uuid',        ]);

        $business->update($validatedData);
        return response()->json($business);
    }

    public function destroy($id)
    {
        $business = Business::find($id);
        if (!$business) {
            return response()->json(['message' => 'Business not found'], 404);
        }

        $business->delete();
        return response()->json(['message' => 'Business deleted successfully']);
    }



}
