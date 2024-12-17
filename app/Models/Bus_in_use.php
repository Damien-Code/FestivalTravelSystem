<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_in_use extends Model
{
    /** @use HasFactory<\Database\Factories\BusInUseFactory> */
    use HasFactory;

    protected $table = 'bus_in_use';
}
