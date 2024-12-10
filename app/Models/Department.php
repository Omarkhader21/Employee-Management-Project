<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    // The table associated with the model
    protected $table = 'departments';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'code',
        'parent_id',
        'description',
    ];

    // Define relationships

    /**
     * Parent department relationship
     */
    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    /**
     * Child departments relationship
     */
    public function children()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }
}
