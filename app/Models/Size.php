<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_id'];

    /* Eloquent */

    public function product() { // 1:N Inversa
        return $this->belongsTo(Product::class);
    }

    public function colors() { // N:M
        return $this->belongsToMany(Color::class)->withPivot('quantity');
    }
}
