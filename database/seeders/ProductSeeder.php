<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(250)->create()->each(function(Product $product) { // each = foreach dentro de un Factory
            Image::factory(4)->create([ // Crea imagenes de un producto (Como Mercado Libre)
                'imageable_id' => $product->id,
                'imageable_type' => $product
            ]);
        });
    }
}
