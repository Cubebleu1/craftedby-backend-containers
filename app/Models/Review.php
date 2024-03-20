<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     schema="Review",
 *     required={"rating", "user_id", "product_id"},
 *     @OA\Property(property="rating", type="integer", format="int32", description="Rating of the product by the user", example=5),
 *     @OA\Property(property="comment", type="string", description="User's comment about the product", example="Great product!", maxLength=1000),
 *     @OA\Property(property="user_id", type="string", format="uuid", description="UUID of the user who wrote the review"),
 *     @OA\Property(property="product_id", type="string", format="uuid", description="UUID of the product being reviewed")
 * )
 */
class Review extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'reviews';
    protected $fillable = [
        'product_id',
        'rating',
        'comment',
        'user_id',
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

}
