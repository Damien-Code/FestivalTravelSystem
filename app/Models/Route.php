<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /** @use HasFactory<\Database\Factories\RouteFactory> */
    use HasFactory;

    protected $fillable = [
        'festival_id',
        'location_id',
        'departure_time',
        'date',
        'price',
    ];
//    public function bus_in_use(){
//        return $this->hasMany(BusInUse::class);
//    }

    public function busInUses()
    {
        return $this->hasMany(BusInUse::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function signups(){
        return $this->hasMany(Order::class)->sum('amount_of_tickets');
    }

    public function festival(){
        return $this->belongsTo(Festival::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }

    protected $table = 'routes';
}
