<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_code',
        'emp_name',
        'depa_code',
        'emp_save',
        'emp_flag',
    ];
}
