<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';
    protected $fillable = [
        'business_id',
        'name',
        'price',
        'stock',
        'material_id',
        'size',
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
