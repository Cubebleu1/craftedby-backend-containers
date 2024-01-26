<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        //Build a query for the Product model
        $query = Product::query();

        // Search for products by name or other attributes
        if ($request->has('search')) {
            $search = $request->input('search');
            //LIKE operator for a partial match search
            $query->where('name', 'LIKE', "%{$search}%");
        }
        // Filter by category
        if ($request->has('category')) {
            $category = $request->input('category');
            //Wherehas for querying relationships
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }
        //Filter by color
        if ($request->has('color')) {
            $color = $request->input('color');
            $query->whereHas('color', function ($query) use ($color) {
                $query->where('name', $color);
            });
        }
        //Filter by material
        if ($request->has('material')) {
            $material = $request->input('material');
            $query->whereHas('material', function ($query) use ($material) {
                $query->where('name', $material);
            });
        }
        // Filter by rating
        if ($request->has('rating')) {
            $rating = $request->input('rating');
            $query->whereHas('reviews', function ($query) use ($rating) {
                $query->where('rating', '=', $rating);
            });
        }
        //Execute query (with eager loading) and get results
        $products = $query->with('business', 'material', 'color')->get();

        return ProductResource::collection($products);

    }

    public function show($id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    public function update(StoreProductRequest $request, $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $validatedData = $request->validated();

        $product->update($validatedData);
        return response()->json($product);
    }

    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
