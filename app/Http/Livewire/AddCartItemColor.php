<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{
    public $product, $colors;
    public $color_id = "";

    public $qty = 1;
    public $quantity = 0;

    public $options = [
        'color_id' => null
    ];

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }

    public function decrement() {
        $this->qty = $this->qty - 1;
    }

    public function increment() {
        $this->qty = $this->qty + 1;
    }

    public function addItem() {
        Cart::add([
                'id' => $this->product->id,
                'name' => $this->product->name,
                'qty' => $this->qty,
                'price' => $this->product->price,
                'weight' => 550,
                'options' => $this->options
            ]);

        /* Refresca cantidad */
        $this->quantity = qty_available($this->product->id, $this->color_id);
        $this->reset('qty');

        /* Refresca el componente carrito */
        $this->emitTo('dropdown-cart', 'render');
    }

    public function mount() {
        $this->colors = $this->product->colors;

        /* Sin imagenes */
        $this->options['image'] = asset('images/product-test.jpg');

        /* Con imagenes */
        //$this->option['image'] = Storage::url($this->product->images->first()->url);
    }

    public function updatedColorId($value) { // updated = clausula para entrar con modelo color_id

        /* Trae el color del producto que selecciono */

        $color = $this->product->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id);

        $this->options['color'] = $color->name;
    }
}
