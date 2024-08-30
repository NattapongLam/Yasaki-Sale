<?php

namespace App\Http\Livewire\SubDistrict;

use Livewire\Component;
use App\Models\District;
use App\Models\SubDistrict;

class SubDistrictForm extends Component
{
    public $idKey = 0;
    public $dist_id;
    public $subd_name;
    public $subd_flag = 1;

    protected $listeners = [
        'editSubDistrict' => 'edit',
        'createSubDistrict' => 'resetInput'
    ];

    protected $rules = [
        'dist_id' => 'required',
        'subd_name' => 'required',
        'subd_flag' => 'required'
    ];

    protected $messages =[
        'dist_id.required' => 'กรุณาระบุข้อมูล',
        'subd_name.required' => 'กรุณาระบุข้อมูล',
        'subd_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function resetInput()
    {
        $this->reset('dist_id');
        $this->reset('subd_name');
        $this->reset('subd_flag');
    }

    public function edit($id)
    {
        $subd = SubDistrict::findOrFail($id);
        $this->idKey = $subd->id;
        $this->dist_id = $subd->dist_id;
        $this->subd_name = $subd->subd_name;
        $this->subd_flag = $subd->subd_flag;
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        SubDistrict::updateOrCreate([
            'id' => $this->idKey
        ],[
            'dist_id' => $this->dist_id,
            'subd_name' => $this->subd_name,
            'subd_save' => auth()->user()->username,
            'subd_flag' => $this->subd_flag
        ]);

        $this->emit('refreshSubDistrict');
        $this->dispatchBrowserEvent('swal',[
            'title' => "บันทึกข้อมูลเรียบร้อย",
            'timer' => 3000,
            'icon' => "success",
        ]);
        $this->emit("modalHide");
       
    }

    public function render()
    {
        return view('livewire.sub-district.sub-district-form',[
            'dist' => District::where('dist_flag',true)->orderBy('dist_name','asc')->get()
        ]);
    }
}
