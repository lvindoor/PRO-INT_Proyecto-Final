<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* Eloquent */

    public function products() { // 1:N
        return $this->hasMany(Product::class);
    }

    public function category() { // 1:N Inversa
        return $this->belongsTo(Category::class);
    }

}
