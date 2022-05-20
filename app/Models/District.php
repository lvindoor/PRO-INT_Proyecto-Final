<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city_id'];

    /* Enloquent */

    public function orders() { // 1:N
        return $this->hasMany(Order::class);
    }

    public function machines() { // 1:N
        return $this->hasMany(Machine::class);
    }
}
