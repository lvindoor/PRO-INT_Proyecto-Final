<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination; // Paginacion dinamica

    public $category, $subcategoryFilter, $brandFilter;

    public $view = "grid"; // Cambio de grid a lista

    public function render()
    {

        /*$products = $this->category->products()
                    ->where('status', Product::PUBLICATED)->paginate(20);*/

        $productsQuery =  Product::query()->whereHas('subcategory.category', function(Builder $query) {
            $query->where('id', $this->category->id);
        });

        if($this->subcategoryFilter) {
            $products = $productsQuery->whereHas('subcategory', function(Builder $query) {
                $query->where('name', $this->subcategoryFilter);
            });
        }

        if($this->brandFilter) {
            $products = $productsQuery->whereHas('brand', function(Builder $query) {
                $query->where('name', $this->brandFilter);
            });
        }

        $products = $productsQuery->paginate(20);

        return view('livewire.category-filter', compact('products'));
    }

    public function clear() {
        $this->reset(['subcategoryFilter','brandFilter']);
    }
}
