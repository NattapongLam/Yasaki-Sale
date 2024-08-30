<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\ProductUnit;

class ProductUnitForm extends Component
{
    public $idKey = 0;
    public $pdui_code;
    public $pdui_name;
    public $pdui_flag = 1;

    protected $listeners = [
        'editProductUnit' => 'edit',
        'createProductUnit' => 'resetInput'
    ];

    protected $rules = [
        'pdui_code' => 'required',
        'pdui_name' => 'required',
        'pdui_flag' => 'required'
    ];

    protected $messages =[
        'pdui_code.required' => 'กรุณาระบุข้อมูล',
        'pdui_name.required' => 'กรุณาระบุข้อมูล',
        'pdui_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function resetInput()
    {
        $this->reset('pdui_code');
        $this->reset('pdui_name');
        $this->reset('pdui_flag');
    }

    public function edit($id)
    {
        $pdui = ProductUnit::findOrFail($id);
        $this->idKey = $pdui->id;
        $this->pdui_code = $pdui->pdui_code;
        $this->pdui_name = $pdui->pdui_name;
        $this->pdui_flag = $pdui->pdui_flag;
    }
    public function save()
    {
        $this->validate($this->rules,$this->messages);
        ProductUnit::updateOrCreate([
            'id' => $this->idKey
        ],[
            'pdui_code' => $this->pdui_code,
            'pdui_name' => $this->pdui_name,
            'pdui_flag' => $this->pdui_flag,
            'pdui_save' => auth()->user()->username
        ]);

        $this->emit('refreshProductUnit');
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
        return view('livewire.product.product-unit-form');
    }
}
