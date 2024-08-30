<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class EmployeeFormPage extends Component
{
    public $idKey=0;
    public $name;
    public $email;
    public $password;
    public $username;
    public $phone;
    public $status=1;

    public function rulesValidate()
    {
        if($this->idKey)
        {
            return[
                'name'=> "required",
                'username'=> "required|unique:users,username,".$this->idKey,
            ];
        }
        else
        {
            return[
                'name'=> "required",
                'password'=> "required|min:4",
                'username'=> "required|unique:users,username",
            ];
        }
    }

    protected $messages = [
        'name.required' => 'กรุณาระบุชื่อพนักงาน',
        'username.required' => 'กรุณาระบุรหัสพนักงาน',
        'username.unique' => 'รหัสพนักงานนี้มีอยู่ในระบบแล้ว',
        'password.required' => 'กรุณาระบุรหัสผ่าน',
        'password.min' => 'กรุณาระบุรหัสผ่าน 6 ตัวขึ้นไป',
    ];
    public function mount($id = 0)
    {
        if($id > 0)
        {
            $employee = User::findOrfail($id);
            $this->idKey = $employee->id;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->username= $employee->username;
            $this->phone= $employee->phone;
            $this->status= $employee->status;
        }
    }

    public function save(){
        $this->validate($this->rulesValidate(),$this->messages);
        $employee = new User();
        if($this->idKey > 0){
            $employee = User::findOrfail($this->idKey);     
            $employee->password = $this->password ? Hash::make($this->password) : $employee->password;    
        }else{           
            $employee->password= Hash::make($this->password);
        }
        $employee->name = $this->name;
        $employee->email= $this->email;          
        $employee->username= $this->username;
        $employee->phone= $this->phone;
        $employee->status= $this->status; 
        $employee->person_at= auth()->user()->username; 
        $employee->save();
        $this->dispatchBrowserEvent('swal',[
            'title' => "บันทึกข้อมูลเรียบร้อย",
            'timer' => 3000,
            'icon' => "success",
            'url' => route('employee.list')
        ]);
    }

    public function render()
    {
        return view('livewire.employee.employee-form-page')->extends('layouts.main');
    }
}
