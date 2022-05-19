<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemSize extends Component
{
    public $product, $sizes;
    public $size_id = "";

    public $color_id = "";
    public $colors = [];

    public $qty = 1;
    public $quantity = 0;

    public $options = [];

    public function render()
    {
        return view('livewire.add-cart-item-size');
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
        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);
        $this->reset('qty');

        /* Refresca el componente carrito */
        $this->emitTo('dropdown-cart', 'render');
    }

    public function mount() {
        $this->sizes = $this->product->size;

        /* Sin imagenes */
        $this->options['image'] = asset('images/product-test.jpg');

        /* Con imagenes */
        //$this->option['image'] = Storage::url($this->product->images->first()->url);
    }

    public function updatedSizeId($value) { // updated = clausula para entrar con modelo size_id

        /* Trae la talla y colores del producto seleccionado */
        $size = Size::find($value);
        $this->colors = $size->colors;

        $this->options['size'] = $size->name;
    }

    public function updatedColorId($value) { // updated = clausula para entrar con modelo size_id

        /* Trae el stock de la talla y color seleccionado */

        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);

        $this->options['color'] = $color->name;
    }
}
