<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_info extends Model
{
    /** @use HasFactory<\Database\Factories\BusInfoFactory> */
    use HasFactory;

    public function bus_in_use(){
        return $this->hasMany(Bus_in_use::class);
    }

    protected $table = 'bus_info';
}
