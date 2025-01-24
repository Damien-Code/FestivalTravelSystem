<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @author Brighton van Rouendal + Mischa Sasse
 */
class FestivalInfo extends Model
{
    /** @use HasFactory<\Database\Factories\FestivalInfoFactory> */
    use HasFactory;

    public function Festival(){
        return $this->hasMany(Festival::class);
    }

    protected $table = 'festival_info';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
