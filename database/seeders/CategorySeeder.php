<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Celulares y Tablets',
                'slug' => Str::slug('Celulares y Tablets'),
                'icon' => '<i class="bi bi-phone"></i>'
            ],

            [
                'name' => 'TV, Audio y Video',
                'slug' => Str::slug('TV, Audio y Video'),
                'icon' => '<i class="bi bi-tv"></i>'
            ],

            [
                'name' => 'Consola y Videojuegos',
                'slug' => Str::slug('Consola y Videojuegos'),
                'icon' => '<i class="bi bi-joystick"></i>'
            ],

            [
                'name' => 'Computación',
                'slug' => Str::slug('Computación'),
                'icon' => '<i class="bi bi-pc-display"></i>'
            ],

            [
                'name' => 'Moda',
                'slug' => Str::slug('Moda'),
                'icon' => '<i class="bi bi-incognito"></i>'
            ]
        ];

        foreach ($categories as $category) {

            $category = Category::factory(1)->create($category)->first(); // Carga Uno a uno

            $brands = Brand::factory(4)->create(); // Carga 4
            foreach ($brands as $brand) {
                /* Cada categoria con 4 Marcas distintas */
                $brand->categories()->attach($category->id); // Toma el id de Brand & Category
            }

        }
    }
}
