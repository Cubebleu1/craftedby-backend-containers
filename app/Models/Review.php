<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'reviews';
    protected $fillable = [
        'product_id',
        'rating',
        'comment',
        'customer_id',
    ];

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'customer_id');
    }

}
