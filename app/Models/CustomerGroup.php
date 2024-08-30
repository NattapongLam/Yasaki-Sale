<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'custgroup_code',
        'custgroup_name',
        'custgroup_flag',
        'custgroup_save'
    ];
}
