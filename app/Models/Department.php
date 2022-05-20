<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /* Enloquent */

    public function cities() { // 1:N
        return $this->hasMany(City::class);
    }

    public function districts() { // 1:N
        return $this->hasMany(District::class);
    }

    public function orders() { // 1:N
        return $this->hasMany(Order::class);
    }
}
