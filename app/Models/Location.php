<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    public function route(){
        return $this->hasMany(Route::class);
    }

    public function festival(){
        return $this->hasMany(Festival::class);
    }

    protected $table = 'locations';
}
