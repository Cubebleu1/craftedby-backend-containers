<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Http\Resources\BusinessResource;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BusinessesController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        //Pass the business param to request
        $request->merge(['business' => true]);

        //Build a query for the Product model
        $query = Business::query();

        //Search for (partial word) in name
        if ($request->has('search')) {
            $search = $request->input('search');
            //LIKE operator for a partial match search
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Filter by specialty (partial word)
        if ($request->has('specialty')) {
            $specialty = $request->input('specialty');
            //whereHas for querying relationships
            $query->whereHas('specialties', function ($query) use ($specialty) {
                $query->where('name', 'LIKE', "%{$specialty}%");
            });
        }
        //Execute query (with eager loading) and get results
        $businesses = $query->with('specialties')->get();

        return BusinessResource::collection($businesses);
    }

    public function show(Request $request, $id) : BusinessResource
    {
        $request->merge(['business' => true]);
        $business = Business::find($id);
        return new BusinessResource($business);

    }

    public function store(StoreBusinessRequest $request)
    {
        $validatedData = $request->validated();

        $business = Business::create($validatedData);
        return response()->json($business, 201);
    }

    public function update(UpdateBusinessRequest $request, $id)
    {
        $business = Business::find($id);
        if (!$business) {
            return response()->json(['message' => 'Business not found'], 404);
        }

        $validatedData = $request->validated();

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
