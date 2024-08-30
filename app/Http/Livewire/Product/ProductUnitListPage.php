<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\ProductUnit;

class ProductUnitListPage extends Component
{
    protected $listeners = [
        'refreshProductUnit' => '$refresh'
    ];

    public function render()
    {
        $pdui =  ProductUnit::get();
        return view('livewire.product.product-unit-list-page',[
            'pdui' => $pdui
        ])->extends('layouts.main');
    }
}
