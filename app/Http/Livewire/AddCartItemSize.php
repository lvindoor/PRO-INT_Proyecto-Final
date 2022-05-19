<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;

class AddCartItemSize extends Component
{
    public $product, $sizes;
    public $size_id = "";

    public $color_id = "";
    public $colors = [];

    public $qty = 1;
    public $quantity = 0;

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }

    public function mount() {
        $this->sizes = $this->product->size;
    }

    public function decrement() {
        $this->qty = $this->qty - 1;
    }

    public function increment() {
        $this->qty = $this->qty + 1;
    }

    public function updatedSizeId($value) { // updated = clausula para entrar con modelo size_id

        /* Trae la talla y colores del producto seleccionado */
        $size = Size::find($value);
        $this->colors = $size->colors;
    }

    public function updatedColorId($value) { // updated = clausula para entrar con modelo size_id

        /* Trae el stock de la talla y color seleccionado */

        $size = Size::find($this->size_id);
        $this->quantity = $size->colors->find($value)->pivot->quantity;
    }
}
