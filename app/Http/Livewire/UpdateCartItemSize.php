<?php

namespace App\Http\Livewire;

use App\Models\Color;
use App\Models\Size;
use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;

class UpdateCartItemSize extends Component
{
    public $rowId, $qty, $quantity;

    public function render()
    {
        return view('livewire.update-cart-item-size');
    }

    public function decrement() {
        $this->qty = $this->qty - 1; // Guarda input
        Cart::update($this->rowId, $this->qty); // Guarda en carrito
        $this->emit('render'); // Refresh carrito
    }

    public function increment() {
        $this->qty = $this->qty + 1; // Guarda en input
        Cart::update($this->rowId, $this->qty); // Guarda en carrito
        $this->emit('render'); // Refresh carrito
    }

    public function mount() {
        $item = Cart::get($this->rowId);
        $this->qty = $item->qty;

        /* Trae el color y talla del producto */
        $color = Color::where('name', $item->options->color)->first();
        $size = Size::where('name', $item->options->size)->first();

        $this->quantity = qty_available($item->id, $color->id, $size->id);
    }

}
