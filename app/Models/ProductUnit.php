<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'pdui_code',
        'pdui_name',
        'pdui_flag',
        'pdui_save'
    ];
}
