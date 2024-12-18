<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'tokens_used',
        'final_price',
        'amount_of_tickets',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function route(){
        return $this->hasOne(Route::class);
    }

    protected $table = 'orders';
}
