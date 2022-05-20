<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost', 'department_id'];

    /* Enloquent */

    public function districts() { // 1:N
        return $this->hasMany(District::class);
    }

    public function orders() { // 1:N
        return $this->hasMany(Order::class);
    }
}
