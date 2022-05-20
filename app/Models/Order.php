<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    /* Estatus de orden */

    const PENDING   = 1;
    const RECEIVED  = 2;
    const SEND      = 3;
    const DELIVERED = 4;
    const CANCELED  = 5;

    /* Tipos de envio */

    const IN_PACKAGE = 1;
    const AT_HOME    = 2;

    /* Enloquent */

    public function complaint() { // 1:1
        return $this->hasOne(Complaint::class);
    }

    public function department() { // 1:N Inversa
        return $this->belongsTo(Department::class);
    }

    public function city() { // 1:N Inversa
        return $this->belongsTo(City::class);
    }

    public function district() { // 1:N Inversa
        return $this->belongsTo(District::class);
    }

    public function user() { // 1:N Inversa
        return $this->belongsTo(User::class);
    }
}
