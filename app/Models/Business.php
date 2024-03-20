<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Business",
 *     required={"name", "address", "postal_code", "city", "country", "phone_number", "email"},
 *     @OA\Property(property="user_id", type="string", format="uuid", description="Owner's user ID"),
 *     @OA\Property(property="name", type="string", description="Business name"),
 *     @OA\Property(property="address", type="string", description="Business address"),
 *     @OA\Property(property="postal_code", type="string", description="Postal code"),
 *     @OA\Property(property="city", type="string", description="City"),
 *     @OA\Property(property="country", type="string", description="Country"),
 *     @OA\Property(property="phone_number", type="string", description="Phone number"),
 *     @OA\Property(property="siret", type="string", description="SIRET number", nullable=true),
 *     @OA\Property(property="craft_id", type="string", format="uuid", description="Craft ID", nullable=true),
 *     @OA\Property(property="specialty_id", type="string", format="uuid", description="Specialty ID", nullable=true),
 *     @OA\Property(property="website", type="string", description="Website URL", nullable=true),
 *     @OA\Property(property="email", type="string", format="email", description="Email address"),
 *     @OA\Property(property="biography", type="string", description="Biography", nullable=true),
 *     @OA\Property(property="history", type="string", description="History", nullable=true),
 *     @OA\Property(property="theme_id", type="string", format="uuid", description="Theme ID", nullable=true),
 * )
 */
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
        'country',
        'phone_number',
        'siret',
        'craft_id',
        'specialty_id',
        'website',
        'email',
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



