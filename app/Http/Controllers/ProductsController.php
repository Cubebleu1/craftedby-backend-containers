<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        //Pass the product param to request
        $request->merge(['product' => true]);

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
        // Filter by minimum price
        if ($request->has('minPrice')) {
            $minPrice = $request->input('minPrice');
            $query->where('price', '>=', $minPrice);
        }

        // Filter by maximum price
        if ($request->has('maxPrice')) {
            $maxPrice = $request->input('maxPrice');
            $query->where('price', '<=', $maxPrice);
        }
        //Execute query (with eager loading) and get results
        $products = $query->with('business', 'material', 'color', 'reviews')->get();

        return ProductResource::collection($products);

    }

    public function show(Request $request, $id): ProductResource
    {
        //Pass the product param to request
        $request->merge(['product' => true]);

        $product = Product::find($id);

        return ProductResource::make($product);
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validated();

        // Check which fields have been pprovided in the request and update only those fields
        $product->name = $validatedData['name'] ?? $product->name;
        $product->price = $validatedData['price'] ?? $product->price;
        $product->stock = $validatedData['stock'] ?? $product->stock;
        $product->material_id = $validatedData['material_id'] ?? $product->material_id;
        $product->size = $validatedData['size'] ?? $product->size;
        $product->weight = $validatedData['weight'] ?? $product->weight;
        $product->color_id = $validatedData['color_id'] ?? $product->color_id;
        $product->customisable = $validatedData['customisable'] ?? $product->customisable;
        $product->image_path = $validatedData['image_path'] ?? $product->image_path;

        // Save the updated product
        $product->save();

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
