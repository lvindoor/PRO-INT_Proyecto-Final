<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ColorProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Obtener los productos con subcategorias que solo tengan color habilitado */

        $products = Product::whereHas('subcategory', function(Builder $query) { // Consulta relaciones
            $query->where('color', true)
                    ->where('size', false);
        })->get();

        /* Asignamos color y cantidad a los productos */

        foreach ($products as $product) {
            $product->colors()->attach([

                /* Colores */

                1 => [ // white
                    'quantity' => 10
                ],

                2 => [ // blue
                    'quantity' => 10
                ],

                3 => [ // red
                    'quantity' => 10
                ],

                4 => [ // black
                    'quantity' => 10
                ]
            ]);
        }
    }
}
