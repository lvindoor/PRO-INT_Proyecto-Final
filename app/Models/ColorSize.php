<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    use HasFactory;

    protected $table = "color_size";

    /* Eloquent */

    public function color() { // 1:N Inversa
        return $this->belongsTo(Color::class);
    }

    public function size() { // 1:N Inversa
        return $this->belongsTo(Size::class);
    }
}
