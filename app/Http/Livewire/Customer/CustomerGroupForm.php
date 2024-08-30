<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\CustomerGroup;

class CustomerGroupForm extends Component
{
    public $idKey = 0;
    public $custgroup_code;
    public $custgroup_name;
    public $custgroup_flag = 1;

    protected $listeners = [
        'editCustomerGroup' => 'edit',
        'createCustomerGroup' => 'resetInput'
    ];

    protected $rules = [
        'custgroup_code' => 'required',
        'custgroup_name' => 'required'
    ];

    protected $messages =[
        'custgroup_code.required' => 'กรุณาระบุข้อมูล',
        'custgroup_name.required' => 'กรุณาระบุข้อมูล',
    ];

    public function edit($id)
    {
        $custgp = CustomerGroup::findOrFail($id);
        $this->idKey = $custgp->id;
        $this->custgroup_code = $custgp->custgroup_code;
        $this->custgroup_name = $custgp->custgroup_name;
        $this->custgroup_flag = $custgp->custgroup_flag;
    }

    public function resetInput()
    {
        $this->reset('custgroup_code');
        $this->reset('custgroup_name');
        $this->reset('custgroup_flag');
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        CustomerGroup::updateOrCreate([
            'id' => $this->idKey
        ],[
            'custgroup_code' => $this->custgroup_code,
            'custgroup_name' => $this->custgroup_name,
            'custgroup_flag' => $this->custgroup_flag,
            'custgroup_save' => auth()->user()->username
        ]);

        $this->emit('refreshCustomerGroup');
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
        return view('livewire.customer.customer-group-form');
    }
}
