<?php

namespace App\Http\Livewire\District;

use Livewire\Component;
use App\Models\District;

class DistrictListPage extends Component
{
    protected $listeners = [
        'refreshDistrict' => '$refresh'
    ];

    public function render()
    {
        $dist = District::leftjoin('provinces','provinces.id','=','districts.prov_id')
        ->select('districts.*','provinces.prov_name')
        ->get();
        return view('livewire.district.district-list-page',[
            'dist' => $dist
        ])->extends('layouts.main');
    }
}
