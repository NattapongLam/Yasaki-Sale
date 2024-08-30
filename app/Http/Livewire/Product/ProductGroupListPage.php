<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\ProductGroup;

class ProductGroupListPage extends Component
{
    protected $listeners = [
        'refreshProductGroup' => '$refresh'
    ];

    public function render()
    {
        $pdgb =  ProductGroup::get();
        return view('livewire.product.product-group-list-page',[
            'pdgb' => $pdgb
        ])->extends('layouts.main');
    }
}
