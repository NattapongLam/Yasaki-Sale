<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'prov_id',
        'dist_name',
        'dist_save',
        'dist_flag'
    ];
    public function province()
    {
        return $this->belongsTo(Province::class,'prov_id');
    }
}
