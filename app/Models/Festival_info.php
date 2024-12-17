<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival_info extends Model
{
    /** @use HasFactory<\Database\Factories\FestivalInfoFactory> */
    use HasFactory;
    
    public function Festival(){
        return $this->hasMany(Festival::class);
    }

    protected $table = 'festival_info';
}
