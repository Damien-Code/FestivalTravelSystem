<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /** @use HasFactory<\Database\Factories\RouteFactory> */
    use HasFactory;

    public function bus_in_use(){
        return $this->hasMany(Bus_in_use::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function festival(){
        return $this->hasOne(Festival::class);
    }

    public function location(){
        return $this->hasOne(Location::class);
    }

    protected $table = 'routes';
}
