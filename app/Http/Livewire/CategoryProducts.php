<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class CategoryProducts extends Component
{
    public $category;

    public $products = [];

    public function loadPosts(){

        /* Obtiene productos publicados */
        $this->products = $this->category->products()
                ->where('status', Product::PUBLICATED)->take(15)->get();

        /* Etiqueta para slider */
        $this->emit('glider', $this->category->id);
    }

    public function render()
    {
        return view('livewire.category-products');
    }
}
