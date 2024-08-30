<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        'dist_id',
        'subd_name',
        'subd_save',
        'subd_flag'
    ];
    public function district()
    {
        return $this->belongsTo(District::class,'dist_id');
    }
}
