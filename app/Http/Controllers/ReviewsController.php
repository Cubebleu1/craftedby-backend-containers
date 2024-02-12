<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ResourceCollection
        {
        //Pass the review param to request
        $request->merge(['review' => true]);

        $query = Review::query();

        //Search for (partial word) in comment
        if ($request->has('search')) {
            $search = $request->input('search');
            //LIKE operator for a partial match search
            $query->where('comment', 'LIKE', "%{$search}%");
        }

        //Filter by rating
        if ($request->has('rating')) {
            $rating = $request->input('rating');
                $query->where('rating', '=', $rating);
        }

        //Execute query and get results
        $reviews = $query->with('product', 'user')->get();
        return ReviewResource::collection($reviews);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
            'customer_id' => 'required|uuid',
            ]);

        $review = Review::create($validatedData);
        return response()->json($review, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        //Pass the review param to request
        $request->merge(['review' => true]);

        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }
        return response()->json($review);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $validatedData = $request->validate([
            'rating' => 'sometimes|integer|between:1,5',
            'comment' => 'sometimes|nullable|string|max:1000',
            ]);

        $review->update($validatedData);
        return response()->json($review);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }

        $review->delete();
        return response()->json(['message' => 'Review deleted successfully']);
    }

}
