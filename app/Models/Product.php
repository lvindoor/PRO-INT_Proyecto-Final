<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const DRAFT      = 1;
    const PUBLICATED = 2;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* Eloquent */

    public function size() { // 1:N
        return $this->hasMany(Size::class);
    }

    public function brand() { // 1:N Inversa
        return $this->belongsTo(Brand::class);
    }

    public function images() { // 1:N Poliformica
        return $this->morphMany(Image::class, 'imageable');
    }

    public function subcategory() { // 1:N Inversa
        return $this->belongsTo(Subcategory::class);
    }

    public function colors() { // N:M
        return $this->belongsToMany(Color::class);
    }

}
