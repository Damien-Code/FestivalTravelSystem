<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusInfo extends Model
{
    /** @use HasFactory<\Database\Factories\BusInfoFactory> */
    use HasFactory;
    use SoftDeletes;

    public function bus_in_use(){
        return $this->hasMany(BusInUse::class);
    }

    protected $fillable = [
        'license_plate',
    ];

    protected $table = 'bus_info';
}
