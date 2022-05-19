<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const DRAFT      = 1;
    const PUBLICATED = 2;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* Accesores */

    public function getStockAttribute() {

        if ($this->subcategory->size) { // ¿Tiene talla?
            return ColorSize::whereHas('size.product', function(Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        } elseif ($this->subcategory->color) { // ¿Tiene color?
            return ColorProduct::whereHas('product', function(Builder $query) {
                $query->where('id', $this->id);
            })->sum('quantity');
        } else {
            return $this->quantity;
        }

    }

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
        return $this->belongsToMany(Color::class)->withPivot('quantity');
    }

    /* URLs Amigables [slug] */

    public function getRouteKeyName() {
        return 'slug';
    }

}
