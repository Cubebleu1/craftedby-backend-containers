<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Annotations as OA;

class ReviewController extends Controller
{
    /**
     * @OA\Get(
     *     path="/reviews",
     *     summary="List all reviews",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search by partial comment",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="rating",
     *         in="query",
     *         description="Filter by rating",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Review")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Invalid request")
     * )
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
     * @OA\Post(
     *     path="/reviews",
     *     summary="Create a new review",
     *     tags={"Reviews"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Review")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Review created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Review")
     *     ),
     *     @OA\Response(response="default", description="Unexpected error")
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
            'user_id' => 'required|uuid',
            'product_id' => 'required|uuid',
            ]);

        $review = Review::create($validatedData);
        return response()->json($review, 201);
    }


    /**
     * @OA\Get(
     *     path="/reviews/{id}",
     *     summary="Display a specific review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Review ID",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Review")
     *     ),
     *     @OA\Response(response=404, description="Review not found")
     * )
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
     * @OA\Put(
     *     path="/reviews/{id}",
     *     summary="Update an existing review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Review ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Review")
     *     ),
     *     @OA\Response(response=200, description="Review updated successfully"),
     *     @OA\Response(response=404, description="Review not found")
     * )
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
     * @OA\Delete(
     *     path="/reviews/{id}",
     *     summary="Delete a review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Review ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Review deleted successfully"),
     *     @OA\Response(response=404, description="Review not found")
     * )
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
