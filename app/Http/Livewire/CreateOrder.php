<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

class CreateOrder extends Component
{
    public $shipping_type = Order::IN_PACKAGE;

    public $contact, $phone, $address, $references, $shipping_cost = 0;

    public $departments, $cities = [], $districts = [];

    public $department_id = "", $city_id = "", $district_id = "";

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'shipping_type' => 'required'
    ];

    public function mount(){
        $this->departments = Department::all();
    }

    public function updatedShippingType($value) { // updated = clausula para entrar a shipping_type
        if($value == Order::IN_PACKAGE) {
            $this->resetValidation([
                'department_id', 'city_id', 'district_id', 'address', 'references'
            ]);
        }
    }

    public function updatedDepartmentId($value) { // updated = clausula para entrar a department_id
        $this->cities = City::where('department_id', $value)->get();
        $this->reset(['city_id','district_id']); // Limpia el ciudad y distrito
    }

    public function updatedCityId($value) { // updated = clausula para entrar a city_id
        $this->districts = District::where('city_id', $value)->get();

        $city = City::find($value);

        /* Obten el costos de envio según la ciudad */
        $this->shipping_cost = $city->cost;

        $this->districts = District::where('city_id', $value)->get();

        /* Limpia el distrito */
        $this->reset('district_id');
    }

    public function create_order() {

        $rules = $this->rules;

        if($this->shipping_type == Order::AT_HOME) {
            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = 'required';
        }

        $this->validate($rules);

        $order = new Order();

        /* Envio gratis */

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->shipping_type = $this->shipping_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content();

        /* Envio a domicilio */

        if($this->shipping_type == Order::AT_HOME) {
            $order->shipping_cost = $this->shipping_cost;
            $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->address = $this->address;
            $order->references = $this->references;
        }

        $order->save();

        Cart::destroy();

        return redirect()->route('orders.payment', $order);

    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
