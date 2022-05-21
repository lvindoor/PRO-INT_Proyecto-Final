<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderController extends Controller
{
    use AuthorizesRequests;

    public function index(){
        return view('orders.index');
    }

    public function show(Order $order) {

        $this->authorize('author', $order);

        $items = json_decode($order->content); // String a Json

        return view('orders.show', compact('order', 'items'));
    }

    public function payment(Order $order) {

        $this->authorize('author', $order);

        $items = json_decode($order->content); // String a Json

        return view('orders.payment', compact('order', 'items'));
    }

    public function pay(Order $order, Request $request) { // Valida el pago

        $this->authorize('author', $order);

        $payment_id = $request->get('payment_id');

        /* Consulta Http hacia API Mercado Pago */

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" .
                        "?access_token=APP_USR-1549287531553747-052016-4688717ac0342320387f47607ff86fd2-1127502430");

        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved') { // ¿Fue aprobada?
            $order->status = Order::RECEIVED;
            $order->save();
        }

        return redirect()->route('orders.show', $order);
    }
}
