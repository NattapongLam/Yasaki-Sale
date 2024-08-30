<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;

class PersonForm extends Component
{
    public $idKey = 0;
    public $emp_code;
    public $emp_name;
    public $depa_code;
    public $emp_flag = 1;

    protected $listeners = [
        'editPerson' => 'edit',
        'createPerson' => 'resetInput'
    ];

    protected $rules = [
        'emp_code' => 'required',
        'emp_name' => 'required',
        'depa_code' => 'required',
        'emp_flag' => 'required',
    ];

    protected $messages =[
        'emp_code.required' => 'กรุณาระบุข้อมูล',
        'emp_name.required' => 'กรุณาระบุข้อมูล',
        'depa_code.required' => 'กรุณาระบุข้อมูล',
        'emp_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function edit($id)
    {
        $emp = Employee::findOrFail($id);
        $this->idKey = $emp->id;
        $this->emp_code = $emp->emp_code;
        $this->emp_name = $emp->emp_name;
        $this->depa_code = $emp->depa_code;
        $this->emp_flag = $emp->emp_flag;
    }

    public function resetInput()
    {
        $this->reset('emp_code');
        $this->reset('emp_name');
        $this->reset('depa_code');
        $this->reset('emp_flag');
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        Employee::updateOrCreate([
            'id' => $this->idKey
        ],[
            'emp_code' => $this->emp_code,
            'emp_name' => $this->emp_name,
            'depa_code' => $this->depa_code,
            'emp_flag' => $this->emp_flag,
            'emp_save' => auth()->user()->username
        ]);

        $this->emit('refreshPerson');
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
        return view('livewire.employee.person-form',[
            'dep' =>  Department::get()
        ]);
    }
}
