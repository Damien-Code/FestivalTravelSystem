<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivalInfo extends Model
{
    /** @use HasFactory<\Database\Factories\FestivalInfoFactory> */
    use HasFactory;

    public function Festival(){
        return $this->hasMany(Festival::class);
    }

    public function decodeImage()
    {
        return base64_decode($this->image) ?? null;
    }

    protected $table = 'festival_info';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
