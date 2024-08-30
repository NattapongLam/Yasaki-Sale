<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;

class PersonListPage extends Component
{
    protected $listeners = [
        'refreshPerson' => '$refresh'
    ];

    public function render()
    {
        $emp = Employee::get();
        return view('livewire.employee.person-list-page',[
            'emp' => $emp
        ])->extends('layouts.main');
    }
}
