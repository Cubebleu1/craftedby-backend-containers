<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'themes';
    protected $fillable = ['name'];

    public function business(): HasMany
    {
        return $this->hasMany(Business::class);
    }
}
