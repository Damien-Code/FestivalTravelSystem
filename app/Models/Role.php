<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Brighton van Rouendal + Mischa Sasse
 */
class Role extends Model
{
    public function user(){
        return $this->hasOne(User::class);
    }

    protected $table = 'roles';
}
