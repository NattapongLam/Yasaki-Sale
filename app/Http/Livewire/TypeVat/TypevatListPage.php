<?php

namespace App\Http\Livewire\TypeVat;

use App\Models\TypeVat;
use Livewire\Component;

class TypevatListPage extends Component
{
    protected $listeners = [
        'refreshTypevat' => '$refresh'
    ];

    public function render()
    {
        $vat = TypeVat::get();
        return view('livewire.type-vat.typevat-list-page',[
            'vat' => $vat
        ])->extends('layouts.main');
    }
}
