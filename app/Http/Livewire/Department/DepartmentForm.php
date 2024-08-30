<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;

class DepartmentForm extends Component
{
    public $idKey = 0;
    public $depa_code;
    public $depa_name;
    public $depa_flag = 1;

    protected $listeners = [
        'editDepartment' => 'edit',
        'createDepartment' => 'resetInput'
    ];

    protected $rules = [
        'depa_code' => 'required',
        'depa_name' => 'required',
        'depa_flag' => 'required'
    ];

    protected $messages =[
        'depa_code.required' => 'กรุณาระบุข้อมูล',
        'depa_name.required' => 'กรุณาระบุข้อมูล',
        'depa_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function edit($id)
    {
        $depa = Department::findOrFail($id);
        $this->idKey = $depa->id;
        $this->depa_code = $depa->depa_code;
        $this->depa_name = $depa->depa_name;
        $this->depa_flag = $depa->depa_flag;
    }
    public function resetInput()
    {
        $this->reset('depa_code');
        $this->reset('depa_name');
        $this->reset('depa_flag');
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        Department::updateOrCreate([
            'id' => $this->idKey
        ],[
            'depa_code' => $this->depa_code,
            'depa_name' => $this->depa_name,
            'depa_save' => auth()->user()->username,
            'depa_flag' => $this->depa_flag,
        ]);

        $this->emit('refreshDepartment');
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
        return view('livewire.department.department-form');
    }
}
