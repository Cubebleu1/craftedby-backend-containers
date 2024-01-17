<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
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
}
