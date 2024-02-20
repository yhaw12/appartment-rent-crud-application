<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tennants extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_name',
        'house',
        'appartment',
        'start_date',
        'end_date',
        'amount',
    ];


    protected $casts = [
        'end_date' => 'datetime',    
    ];

    public function getAppartmentAttribute($value)
    {
        // Perform any necessary transformations on $value
        // and return the result.
        return $value;
    }
}
