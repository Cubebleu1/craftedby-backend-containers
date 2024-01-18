<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Craft extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'crafts';
    protected $fillable = ['name'];

    public function business(): HasMany
    {
        return $this->hasMany(Business::class);
    }
}
