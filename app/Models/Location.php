<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'country',
        'city',
        'street',
    ];
    public function routes(){
        return $this->hasMany(Route::class);
    }

    public function festivals(){
        return $this->hasMany(Festival::class);
    }

    public function address() {
        return "{$this->country}, {$this->city} {$this->street}";
    }

    protected $table = 'locations';
}
