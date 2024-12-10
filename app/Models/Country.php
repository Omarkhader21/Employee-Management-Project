<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    // The table associated with the model
    protected $table = 'countries';

    // The attributes that are mass assignable
    protected $fillable = [
        'country_code',
        'name',
        'region',
        'phone_code',
    ];

    // Define relationships

    /**
     * States relationship
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
