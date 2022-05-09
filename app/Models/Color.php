<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /* Eloquent */

    public function products() { // N:M
        return $this->belongsToMany(Product::class);
    }

    public function sizes() { // N:M
        return $this->belongsToMany(Size::class);
    }
}
