<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    /** @use HasFactory<\Database\Factories\FestivalFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
    ];
    public function route(){
        return $this->hasMany(Route::class);
    }

    public function location(){
        return $this->hasOne(Location::class);
    }

    public function festivalInfo(){
        return $this->hasOne(FestivalInfo::class);
    }

    protected $table = 'festivals';
}
