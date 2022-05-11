<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /* Eloquent */

    public function products() { // 1:N
        return $this->hasMany(Product::class);
    }

    public function categories() { // N:M
        return $this->belongsToMany(Category::class);
    }

}
