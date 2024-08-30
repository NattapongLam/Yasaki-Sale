<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionFormPage extends Component
{
    public $role;
    public $permission = [];
    public $employee;

    public function mount($id)
    {
        $employee = User::findOrFail($id);
        if($employee){
            $this->role = !empty($employee->getRoleNames()[0]) ? $employee->getRoleNames()[0] : '';
            $this->employee = $employee;     
        }
    }

    public function save()
    {
        $role = Role::where('name',$this->role)->first();       
        $this->employee->syncRoles($role->name);
        //$this->employee->syncPermissions([$this->permission]);
        $this->dispatchBrowserEvent('swal',[
            'title' => "บันทึกข้อมูลเรียบร้อย",
            'timer' => 3000,
            'icon' => "success",
            'url' => route('employee.list')
        ]);
    }

    public function render()
    {
        return view('livewire.employee.role-permission-form-page',[
            'roles' => Role::all(),
            //'permissions' => Permission::all()
        ])->extends('layouts.main');
    }
}
