<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'address',
    ];
    public function route(){
        return $this->hasMany(Route::class);
    }

    public function festival(){
        return $this->hasMany(Festival::class);
    }

    protected $table = 'locations';
}
