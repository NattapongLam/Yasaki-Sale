<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\ProductGroup;

class ProductGroupForm extends Component
{
    public $idKey = 0;
    public $pdgp_code;
    public $pdgp_name;
    public $pdgp_flag = 1;

    protected $listeners = [
        'editProductGroup' => 'edit',
        'createProductGroup' => 'resetInput'
    ];

    protected $rules = [
        'pdgp_code' => 'required',
        'pdgp_name' => 'required',
        'pdgp_flag' => 'required'
    ];

    protected $messages =[
        'pdgp_code.required' => 'กรุณาระบุข้อมูล',
        'pdgp_name.required' => 'กรุณาระบุข้อมูล',
        'pdgp_flag.required' => 'กรุณาระบุข้อมูล',
    ];

    public function resetInput()
    {
        $this->reset('pdgp_code');
        $this->reset('pdgp_name');
        $this->reset('pdgp_flag');
    }

    public function edit($id)
    {
        $pdgp = ProductGroup::findOrFail($id);
        $this->idKey = $pdgp->id;
        $this->pdgp_code = $pdgp->pdgp_code;
        $this->pdgp_name = $pdgp->pdgp_name;
        $this->pdgp_flag = $pdgp->pdgp_flag;
    }

    public function save()
    {
        $this->validate($this->rules,$this->messages);
        ProductGroup::updateOrCreate([
            'id' => $this->idKey
        ],[
            'pdgp_code' => $this->pdgp_code,
            'pdgp_name' => $this->pdgp_name,
            'pdgp_flag' => $this->pdgp_flag,
            'pdgp_save' => auth()->user()->username
        ]);

        $this->emit('refreshProductGroup');
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
        return view('livewire.product.product-group-form');
    }
}
