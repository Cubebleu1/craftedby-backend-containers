<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Annotations as OA;

class ProductController extends Controller
{
    /**
     * Display a list of products, with optional filters
     * @OA\Get(
     *     path="/products",
     *     summary="Get a list of (filtered) products",
     *     tags={"Products"},
     *          @OA\Parameter(
     *          name="search",
     *          in="query",
     *          description="Search by (partial) name",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *           @OA\Parameter(
     *           name="color",
     *           in="query",
     *           description="Add color filter (e.g. blue, red, yellow)",
     *           required=false,
     *           @OA\Schema(type="string")
     *       ),
     *            @OA\Parameter(
     *            name="category",
     *            in="query",
     *            description="Add category filter (e.g. nourriture, meubles, jouets)",
     *            required=false,
     *            @OA\Schema(type="string")
     *        ),
     *          @OA\Parameter(
     *          name="material",
     *          in="query",
     *          required=false,
     *          description="Filter by product material (e.g. céramique, plâtre, bois)",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="rating",
     *          in="query",
     *          required=false,
     *          description="Filter by product rating (e.g. 1, 2, 5)",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="priceRange.min",
     *          in="query",
     *          required=false,
     *          description="Minimum price range for products",
     *          @OA\Schema(type="number", format="decimal")
     *      ),
     *      @OA\Parameter(
     *          name="priceRange.max",
     *          in="query",
     *          required=false,
     *          description="Maximum price range for products",
     *          @OA\Schema(type="number", format="decimal")
     *      ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request"),
     *     @OA\Response(response=404, description="Product(s) not found")
     * )
     */
    public function index(Request $request): ResourceCollection
//    public function index(Request $request): PaginatedResourceResponse
    {
        //Pass the product param to request
        $request->merge(['product' => true]);

        //Build a query for the Product model
        $query = Product::query();

        // Search for products by name or other attributes
        if ($request->filled('search')) {

            $request->validate([
                'search' => 'required|string',
            ]);

            $search = $request->input('search');
            //LIKE operator for a partial match search
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        }
        // Filter by category
        if ($request->filled('category')) {

            $request->validate([
                'category' => 'required|string',
            ]);
            $category = $request->input('category');
            //Wherehas for querying relationships
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }
        //Filter by color
        if ($request->filled('color')) {
            $color = $request->input('color');
            $query->whereHas('color', function ($query) use ($color) {
                $query->where('name', $color);
            });
        }
        //Filter by material
        if ($request->filled('material')) {
            $material = $request->input('material');
            $query->whereHas('material', function ($query) use ($material) {
                $query->where('name', $material);
            });
        }
        // Filter by rating
        if ($request->filled('rating')) {
            $rating = $request->input('rating');
            $query->whereHas('reviews', function ($query) use ($rating) {
                $query->where('rating', '=', $rating);
            });
        }
        // Filter by minimum price
        if ($request->filled('priceRange.min')) {
            $minPrice = $request->input('priceRange.min');
            $query->where('price', '>=', $minPrice);
        }

        // Filter by maximum price
        if ($request->filled('priceRange.max')) {
            $maxPrice = $request->input('priceRange.max');
            $query->where('price', '<=', $maxPrice);
        }
        //Filter (non)customisable products
        if ($request->filled('customisable')) {
            $customisable = $request->input('customisable');
            $query->where('customisable', '=', $customisable);
        }

        //Execute query (with eager loading) and get results
//        $products = $query->with('business', 'material', 'color', 'reviews')->get();
        $products = $query->with('business', 'material', 'color', 'reviews')->paginate(12);

        return ProductResource::collection($products);
//        return ProductResource::paginate(10);

    }

    /**
     * Display a product by id.
     * @OA\Get(
     *     path="/products/{id}",
     *     summary="Display a specific product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Product ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request"),
     *     @OA\Response(response=404, description="Product(s) not found")
     * )
     */
    public function show(Request $request, $id): ProductResource
    {
        //Pass the product param to request
        $request->merge(['product' => true]);

        $product = Product::find($id);

        return ProductResource::make($product);
    }

    /**
     * Store a newly created product in storage.
     *
     * @OA\Post(
     *     path="/products",
     *     summary="Create a new product",
     *     tags={"Products"},
     *     security={ {"sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Product")
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Unexpected error",
     *     )
     * )
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *     path="/products/{id}",
     *     summary="Update a product",
     *     tags={"Products"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Product ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(response=200, description="Product updated successfully"),
     *     @OA\Response(response=404, description="Product not found")
     * )
     */
    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validated();

        // Check which fields have been provided in the request else default to existing value
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

    /**
     * Remove the specified resource from storage.
     *
     * @OA\Delete(
     *     path="/products/{id}",
     *     summary="Delete a product",
     *     tags={"Products"},
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Product ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response=200, description="Product deleted successfully"),
     *     @OA\Response(response=404, description="Product not found")
     * )
     */
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
