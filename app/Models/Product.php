<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'pd_code',
        'pd_name',
        'pd_unit',
        'pd_group',
        'pd_stc',
        'pd_price',
        'pd_flag',
        'pd_save',
    ];
}
