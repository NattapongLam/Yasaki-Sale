<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
      'customer_code',
      'customer_name',
      'customer_contact',
      'customer_flag',
      'customer_save',
      'custgroup_id',
      'customer_address',
      'province_id',
      'district_id',
      'subdistrict_id',
      'customer_zipcode',
      'employee_id',
      'customer_creditday',
      'custgroup_code',
      'custgroup_name',
      'province_name',
      'district_name',
      'subdistrict_name',
      'sale_code',
      'sale_name'
    ];
}
