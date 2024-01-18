<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'specialties';
    protected $fillable = ['name'];

    public function businesses() : HasMany
    {
        return $this->hasMany(Business::class, 'craft_id');
    }

}
