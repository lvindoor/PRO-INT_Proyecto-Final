<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'user_id'];

    /* Enloquent */

    public function user() { // 1:N Inversa
        return $this->belongsTo(User::class);
    }

}
