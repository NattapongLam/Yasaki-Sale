<?php

namespace App\Http\Livewire\TypeVat;

use App\Models\TypeVat;
use Livewire\Component;

class TypevatForm extends Component
{
    public $idKey = 0;
    public $vat_code;
    public $vat_rate;
    public $vat_flag=1;

    protected $listeners = [
        'editTypevat' => 'edit',
        'createTypevat' => 'resetInput'
    ];

    protected $rules = [
        'vat_code' => 'required',
        'vat_rate' => 'required',
        'vat_flag' => 'required',
    ];

    protected $messages =[
        'vat_code.required' => 'กรุณาระบุข้อมูล',
        'vat_rate.required' => 'กรุณาระบุข้อมูล',
        'vat_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function edit($id)
    {
        $vat = TypeVat::findOrFail($id);
        $this->idKey = $vat->id;
        $this->vat_code = $vat->vat_code;
        $this->vat_rate = $vat->vat_rate;
        $this->vat_flag = $vat->vat_flag;
    }

    public function resetInput()
    {
        $this->reset('vat_code');
        $this->reset('vat_rate');
        $this->reset('vat_flag');
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        TypeVat::updateOrCreate([
            'id' => $this->idKey
        ],[
            'vat_code' => $this->vat_code,
            'vat_rate' => $this->vat_rate,
            'vat_flag' => $this->vat_flag,
            'vat_save' => auth()->user()->username
        ]);

        $this->emit('refreshTypevat');
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
        return view('livewire.type-vat.typevat-form');
    }
}
