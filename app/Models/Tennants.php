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
        'appartment_number',
        'start_date',
        'end_date',
        'amount',
    ];
}
