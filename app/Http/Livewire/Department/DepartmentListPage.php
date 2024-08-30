<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\Department;

class DepartmentListPage extends Component
{
    protected $listeners = [
        'refreshDepartment' => '$refresh'
    ];

    public function render()
    {
        $depa = Department::get();
        return view('livewire.department.department-list-page',[
            'depa' => $depa
        ])->extends('layouts.main');
    }
}
