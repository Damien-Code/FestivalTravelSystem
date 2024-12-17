<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival_info extends Model
{
    /** @use HasFactory<\Database\Factories\FestivalInfoFactory> */
    use HasFactory;

    protected $table = 'festival_info';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
