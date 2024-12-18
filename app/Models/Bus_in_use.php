<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_in_use extends Model
{
    /** @use HasFactory<\Database\Factories\BusInUseFactory> */
    use HasFactory;

    public function bus_info(){
        return $this->hasOne(Bus_info::class);
    }
    public function route(){
        return $this->hasOne(Route::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }

    protected $table = 'bus_in_use';

}
