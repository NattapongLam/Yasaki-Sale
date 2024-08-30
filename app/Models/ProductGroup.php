<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'pdgp_code',
        'pdgp_name',
        'pdgp_flag',
        'pdgp_save'
    ];
}
