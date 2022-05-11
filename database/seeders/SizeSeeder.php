<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Obtener los productos con subcategorias que tengan color y size habilitado */

        $products = Product::whereHas('subcategory', function(Builder $query) { // Consulta relaciones
            $query->where('color', true)
                    ->where('size', true);
        })->get();

        /* Asignamos las tallas a los productos */

        $sizes = ['Talla S','Talla M','Talla L'];

        foreach ($products as $product) {

            foreach ($sizes as $size) {

                $product->size()->create([
                    'name' => $size
                ]);

            }
        }
    }
}
