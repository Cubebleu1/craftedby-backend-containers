<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Business extends Model
{
    use HasFactory;

    /**
     * Keytype is not default int 'id' but string 'uuid'
     * @var string
     */
    protected $keyType = 'string';
    //
    /**
     * Don't increment the key 'id'
     * @var bool
     */
    public $incrementing = false;

    public static function booted() {
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

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
