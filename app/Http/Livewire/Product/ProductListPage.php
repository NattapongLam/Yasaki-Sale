<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class ProductListPage extends Component
{
    public function render()
    {
        $pd = Product::get();
        return view('livewire.product.product-list-page',[
            'pd'  => $pd
        ])->extends('layouts.main');
    }
}
