<?php

namespace App\Http\Livewire\Province;

use Livewire\Component;
use App\Models\Province;

class ProvinceForm extends Component
{
    public $idKey = 0;
    public $prov_name;
    public $prov_flag = 1;

    protected $listeners = [
        'editProvince' => 'edit',
        'createProvince' => 'resetInput'
    ];

    protected $rules = [
        'prov_name' => 'required',
        'prov_flag' => 'required'
    ];

    protected $messages =[
        'prov_name.required' => 'กรุณาระบุข้อมูล',
        'prov_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function edit($id)
    {
        $prov = Province::findOrFail($id);
        $this->idKey = $prov->id;
        $this->prov_name = $prov->prov_name;
        $this->prov_flag = $prov->prov_flag;
    }

    public function resetInput()
    {
        $this->reset('prov_name');
        $this->reset('prov_flag');
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        Province::updateOrCreate([
            'id' => $this->idKey
        ],[
            'prov_name' => $this->prov_name,
            'prov_flag' => $this->prov_flag,
            'prov_save' => auth()->user()->username
        ]);

        $this->emit('refreshProvince');
        $this->dispatchBrowserEvent('swal',[
            'title' => "บันทึกข้อมูลเรียบร้อย",
            'timer' => 3000,
            'icon' => "success",
            //'url' => route('province.list')
        ]);
        $this->emit("modalHide");
       
    }
    
    public function render()
    {
        return view('livewire.province.province-form');
    }
}
