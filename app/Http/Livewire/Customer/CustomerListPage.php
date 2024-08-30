<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;

class CustomerListPage extends Component
{
    public function render()
    {
        $cust = Customer::get();
        return view('livewire.customer.customer-list-page',[
            'cust' =>  $cust
        ])->extends('layouts.main');
    }
}
