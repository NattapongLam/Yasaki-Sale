<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\CustomerGroup;

class CustomerFormPage extends Component
{
    public $idKey=0;
    public $customer_code;
    public $customer_name;
    public $sale_code;
    public $customer_flag=1;
    public $custgroup_id;
    public $customer_address;
    public $province_id;
    public $district_id;
    public $subdistrict_id;
    public $customer_zipcode;

    public function mount($id = 0)
    {
        if($id > 0)
        {
            $cust = Customer::findOrfail($id);
            $this->idKey = $cust->id;
            $this->customer_code = $cust->customer_code;
            $this->customer_name = $cust->customer_name;
            $this->sale_code = $cust->sale_code;
            $this->customer_flag = $cust->customer_flag;
            $this->custgroup_id = $cust->custgroup_id;
            $this->customer_address = $cust->customer_address;
            $this->province_id = $cust->province_id;
            $this->district_id = $cust->district_id;
            $this->subdistrict_id = $cust->subdistrict_id;
            $this->customer_zipcode = $cust->customer_zipcode;
        }
    }

    public function save(){
        $this->validate($this->rulesValidate(),$this->messages);
        $customer = new Customer();
        if($this->idKey > 0){
            $customer = Customer::findOrfail($this->idKey);     
           
        }else{           
            $customer->customer_code = $this->customer_code;
        } 
        $customer->customer_name = $this->customer_name;
        $customer->sale_code = $this->sale_code;
        $customer->customer_flag = $this->customer_flag;
        $customer->customer_save= auth()->user()->username; 
        $customer->save();
        $this->dispatchBrowserEvent('swal',[
            'title' => "บันทึกข้อมูลเรียบร้อย",
            'timer' => 3000,
            'icon' => "success",
            'url' => route('customer.list')
        ]);
    }

    public function render()
    {
        return view('livewire.customer.customer-form-page',[
            'custgp' => CustomerGroup::get(),
            'prov' => Province::get(),
            'dist' => District::get(),
            'sbdi' => SubDistrict::get()
        ])->extends('layouts.main');
    }
}
