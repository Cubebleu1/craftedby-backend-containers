<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();
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
