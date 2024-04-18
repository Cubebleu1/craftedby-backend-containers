<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(schema="Product",
 *     @OA\Property(property="business_id", type="string", format="uuid"),
 *     @OA\Property(property="name", type="string", maxLength=255),
 *     @OA\Property(property="description", type="string"),
 *     @OA\Property(property="price", type="number"),
 *     @OA\Property(property="stock", type="integer"),
 *     @OA\Property(property="material_id", type="string", format="uuid"),
 *     @OA\Property(property="size", type="string", maxLength=100),
 *     @OA\Property(property="weight", type="number"),
 *     @OA\Property(property="color_id", type="string", format="uuid"),
 *     @OA\Property(property="customisable", type="boolean"),
 *     @OA\Property(property="image_path", type="string", maxLength=255)
 * )
 */
class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price',
        'stock',
        'material_id',
        'size',
        'weight',
        'color_id',
        'customisable',
        'image_path',
    ];

    public function business(): BelongsTo {
        return $this->belongsTo(Business::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function material(): BelongsTo {
        return $this->belongsTo(Material::class);
    }

    public function color(): BelongsTo {
        return $this->belongsTo(Color::class);
    }

    public function reviews(): HasMany {
        return $this->hasMany(Review::class);
    }

    public function orders(): BelongsToMany {
        return $this->belongsToMany(Order::class);
    }

}
