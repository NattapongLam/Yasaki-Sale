<?php

namespace App\Http\Livewire\Province;

use Livewire\Component;
use App\Models\Province;

class ProvinceListPage extends Component
{
    protected $listeners = [
        'refreshProvince' => '$refresh'
    ];

    public function render()
    {
        $prov =  Province::get();
        return view('livewire.province.province-list-page',[
            'prov' => $prov
        ])->extends('layouts.main');
    }
}
