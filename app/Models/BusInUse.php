<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusInUse extends Model
{
    /** @use HasFactory<\Database\Factories\BusInUseFactory> */
    use HasFactory;

    protected $fillable = [
        'route_id',
        'bus_id',
        'user_id'
    ];

    public function busInfo(){
        return $this->belongsTo(BusInfo::class);
    }
    public function routes(){
        return $this->belongsTo(Route::class, 'route_id');
    }
    public function user(){
        return $this->hasOne(User::class);
    }

    protected $table = 'bus_in_uses';

}
