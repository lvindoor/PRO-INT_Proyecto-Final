<?php

use App\Models\Product;
use App\Models\Size;

use Gloudemans\Shoppingcart\Facades\Cart;

function quantity($product_id, $color_id = null, $size_id = null) { // (color_id & size_id) Opcionales

    /* Recupera stock */

    $product = Product::find($product_id);

    if($size_id) { // ¿Es por tala?
        $size = Size::find($size_id);
        $quantity = $size->colors->find($color_id)->pivot->quantity;
    } elseif($color_id) { // ¿Es por color?
        $quantity = $product->colors->find($color_id)->pivot->quantity;
    } else {
        $quantity = $product->quantity;
    }

    return $quantity;
}

function qty_added($product_id, $color_id = null, $size_id = null) { // (color_id & size_id) Opcionales

    $cart = Cart::content();

    /* Recupera stock en carrito */

    $item = $cart->where('id', $product_id)
                    ->where('options.color_id', $color_id)
                    ->where('options.size_id', $size_id)
                    ->first();

    if($item) { // ¿Tenemos items en el carrito?
        return $item->qty;
    } else {
        return 0;
    }

}

function qty_available($product_id, $color_id = null, $size_id = null) { // (color_id & size_id) Opcionales

    /* Calcula el stock actual */

    return quantity($product_id, $color_id, $size_id) - qty_added($product_id, $color_id, $size_id);
}
