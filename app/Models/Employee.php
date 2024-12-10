<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    // The table associated with the model (optional if it matches 'employees')
    protected $table = 'employees';

    // The attributes that are mass assignable
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'address',
        'department_id',
        'city_id',
        'state_id',
        'country_id',
        'zip_code',
        'birthdate',
        'date_hired',
    ];

    // Cast attributes to specific types
    protected $casts = [
        'birthdate' => 'date',
        'date_hired' => 'date',
    ];

    // Define relationships

    /**
     * Department relationship
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * City relationship
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * State relationship
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * Country relationship
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
