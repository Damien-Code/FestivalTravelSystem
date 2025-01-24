<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @author Brighton van Rouendal + Mischa Sasse
 */
class BusInfo extends Model
{
    /** @use HasFactory<\Database\Factories\BusInfoFactory> */
    use HasFactory;
    use SoftDeletes;

    public function busInUses(){
        return $this->hasMany(BusInUse::class, 'bus_id');
    }
    
    public function routesPlannedWithBus() {
        return $this->belongsToMany(Route::class, BusInUse::class, 'bus_id', 'route_id')->where('departure_time', '>=', now())->count();
        }

    protected $fillable = [
        'license_plate',
    ];

    protected $table = 'bus_info';
}
