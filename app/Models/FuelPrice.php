<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelPrice extends Model
{
    use HasFactory;

    public $fillable = [
        'station_id',
        'diesel',
        'e5',
        'e10',
        'open',
    ];
}
