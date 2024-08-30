<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\CustomerGroup;

class CustomerGroupListPage extends Component
{
    protected $listeners = [
        'refreshCustomerGroup' => '$refresh'
    ];

    public function render()
    {
        $custgp =  CustomerGroup::get();
        return view('livewire.customer.customer-group-list-page',[
            'custgp' => $custgp
        ])->extends('layouts.main');
    }
}
