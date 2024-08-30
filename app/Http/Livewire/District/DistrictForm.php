<?php

namespace App\Http\Livewire\District;

use Livewire\Component;
use App\Models\District;
use App\Models\Province;

class DistrictForm extends Component
{
    public $idKey = 0;
    public $prov_id;
    public $dist_name;
    public $dist_flag = 1;

    protected $listeners = [
        'editDistrict' => 'edit',
        'createDistrict' => 'resetInput'
    ];

    protected $rules = [
        'prov_id' => 'required',
        'dist_name' => 'required',
        'dist_flag' => 'required'
    ];

    protected $messages =[
        'prov_id.required' => 'กรุณาระบุข้อมูล',
        'dist_name.required' => 'กรุณาระบุข้อมูล',
        'dist_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function resetInput()
    {
        $this->reset('prov_id');
        $this->reset('dist_name');
        $this->reset('dist_flag');
    }

    public function edit($id)
    {
        $dist = District::findOrFail($id);
        $this->idKey = $dist->id;
        $this->prov_id = $dist->prov_id;
        $this->dist_name = $dist->dist_name;
        $this->dist_flag = $dist->dist_flag;
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        District::updateOrCreate([
            'id' => $this->idKey
        ],[
            'prov_id' => $this->prov_id,
            'dist_name' => $this->dist_name,
            'dist_save' => auth()->user()->username,
            'dist_flag' => $this->dist_flag
        ]);

        $this->emit('refreshDistrict');
        $this->dispatchBrowserEvent('swal',[
            'title' => "บันทึกข้อมูลเรียบร้อย",
            'timer' => 3000,
            'icon' => "success",
        ]);
        $this->emit("modalHide");
       
    }
    


    public function render()
    {
        return view('livewire.district.district-form',[
            'prov' => Province::where('prov_flag',true)->orderBy('prov_name','asc')->get()
        ]);
    }
}
