<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','image','icon'];

    /* Eloquent */

    public function subcategories() { // 1:N
        return $this->hasMany(Subcategory::class);
    }

    public function products() { // 1:N A traves de ...
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }

    public function brands() { // N:M
        return $this->belongsToMany(Brand::class);
    }

    /* URLs Amigables [slug] */

    public function getRouteKeyName() {
        return 'slug';
    }

}
