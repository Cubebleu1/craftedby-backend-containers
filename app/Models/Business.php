<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'businesses';
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'postal_code',
        'city',
        'siret',
        'craft_id',
        'specialty_id',
        'website',
        'biography',
        'history',
        'theme_id',
    ];

public function user(): BelongsTo {
    return $this->belongsTo(User::class);
}

public function products(): HasMany {
    return $this->hasMany(Product::class);
}

public function specialties(): BelongsToMany {
    return $this->belongsToMany(Specialty::class);
}

public function craft(): BelongsTo {
    return $this->belongsTo(Craft::class);
}

public function theme(): BelongsTo {
    return $this->belongsTo(Theme::class);
}
}



