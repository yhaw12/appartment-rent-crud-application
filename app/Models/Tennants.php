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
        'duration',
        'end_date',
        'amount',
    ];


    public function getAppartmentAttribute($value)
    {
        // Perform any necessary transformations on $value
        // and return the result.
        return $value;
    }
}
