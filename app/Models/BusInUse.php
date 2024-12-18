<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusInUse extends Model
{
    /** @use HasFactory<\Database\Factories\BusInUseFactory> */
    use HasFactory;

    public function busInfo(){
        return $this->belongsTo(BusInfo::class);
    }
    public function belongsToRoute(){
        return $this->belongsTo(Route::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }

    protected $table = 'bus_in_uses';

}
