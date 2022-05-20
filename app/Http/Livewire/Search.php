<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{

    public $search;
    public $open = false;

    public function render()
    {

        if ($this->search) { /* ¿Esta haciendo una busqueda? */

            $products = Product::where('name', 'LIKE', '%'.$this->search.'%') // Busqueda con LIKE
                                ->where('status', Product::PUBLICATED)
                                ->take(8) // Limita a 8 productos
                                ->get();
        } else {
            $products = [];
        }

        return view('livewire.search', compact('products'));
    }

    public function updatedSearch($value) { // updated = clausula para entrar search

        if ($value) { /* ¿Escribe algo? */
            $this->open = true;
        } else {
            $this->open = false;
        }

    }
}
