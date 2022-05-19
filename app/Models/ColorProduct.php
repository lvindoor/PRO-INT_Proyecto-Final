<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    use HasFactory;

    protected $table = "color_product";

    /* Eloquent */

    public function color() { // 1:N Inversa
        return $this->belongsTo(Color::class);
    }

    public function product() { // 1:N Inversa
        return $this->belongsTo(Product::class);
    }

}
