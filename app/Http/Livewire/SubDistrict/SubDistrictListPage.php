<?php

namespace App\Http\Livewire\SubDistrict;

use Livewire\Component;
use App\Models\SubDistrict;

class SubDistrictListPage extends Component
{
    protected $listeners = [
        'refreshSubDistrict' => '$refresh'
    ];
    public function render()
    {
        $subd = SubDistrict::leftjoin('districts','sub_districts.dist_id','=','districts.id')
        ->leftjoin('provinces','districts.prov_id','=','provinces.id')
        ->select('sub_districts.*','districts.dist_name','provinces.prov_name')
        ->get();
        return view('livewire.sub-district.sub-district-list-page',[
            'subd' => $subd
        ])->extends('layouts.main');
    }
}
