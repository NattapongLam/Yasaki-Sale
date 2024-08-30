<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVat extends Model
{
    use HasFactory;
    protected $fillable = [
        'vat_code',
        'vat_rate',
        'vat_flag',
        'vat_save'
    ];
}
