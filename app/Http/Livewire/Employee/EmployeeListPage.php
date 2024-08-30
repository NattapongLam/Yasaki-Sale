<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Livewire\Component;

class EmployeeListPage extends Component
{   
    public function render()
    {
        $emp = User::get();
        return view('livewire.employee.employee-list-page',[
            'emp' => $emp
        ])->extends('layouts.main');
    }
}
