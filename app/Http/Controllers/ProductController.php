<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        //Query builder instance for Product model
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
        //Filter vy color
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
            $query->whereHas('reviews', function ($q) use ($rating) {
                $q->where('rating', '=', $rating);
            });
        }
        //Execute query and get results
        $products = $query->get();
        return response()->json($products);
    }

    public function show($id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'business_id' => 'required|uuid',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'material_id' => 'required|uuid',
            'size' => 'required|string|max:100',
            'color_id' => 'required|uuid',
            'customisable' => 'required|boolean',
            'image_path' => 'nullable|string|max:255'
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'business_id' => 'sometimes|uuid',
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'stock' => 'sometimes|integer',
            'material_id' => 'sometimes|uuid',
            'size' => 'sometimes|string|max:100',
            'color_id' => 'sometimes|uuid',
            'customisable' => 'sometimes|boolean',
            'image_path' => 'sometimes|nullable|string|max:255'
        ]);

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
