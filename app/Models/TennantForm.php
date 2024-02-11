<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TennantForm extends Model
{
    use HasFactory;
    protected $fillable = [
        'tenant_name',
        'house',
        'apartment_number',
        'start_date',
        'end_date',
        'amount'
    ];
}
