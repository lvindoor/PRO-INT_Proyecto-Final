<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    /* Enloquent */

    public function district() { // 1:N Inversa
        return $this->belongsTo(District::class);
    }
}
