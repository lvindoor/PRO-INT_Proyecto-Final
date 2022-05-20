<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCart extends Component
{
    protected $listeners = ['render'];

    public function render()
    {
        return view('livewire.shopping-cart');
    }

    public function delete($rowId) {
        Cart::remove($rowId); // Elimina producto
    }

    public function destroy() {
        Cart::destroy(); // Limpia carrito
        $this->emitTo('dropdown-cart', 'render'); // Refresh
    }
}
