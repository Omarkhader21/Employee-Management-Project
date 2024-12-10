<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    // The table associated with the model
    protected $table = 'cities';

    // The attributes that are mass assignable
    protected $fillable = [
        'state_id',
        'name',
        'postal_code',
        'population',
    ];

    // Define relationships

    /**
     * State relationship
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
