<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class CategoryProducts extends Component
{
    public $category;

    public $products = [];

    public function render()
    {
        return view('livewire.category-products');
    }

    public function loadPosts() {

        /* Obtiene productos publicados */
        $this->products = $this->category->products()
                ->where('status', Product::PUBLICATED)->take(15)->get();

        /* Etiqueta para llamar slider */
        $this->emit('slider');
    }
}
