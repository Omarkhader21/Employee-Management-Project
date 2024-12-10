<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;

    // The table associated with the model
    protected $table = 'states';

    // The attributes that are mass assignable
    protected $fillable = [
        'country_id',
        'name',
        'abbreviation',
        'state_code',
    ];

    // Define relationships

    /**
     * Country relationship
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Cities relationship
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
