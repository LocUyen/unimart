<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function order()
    {
        return $this->hasOne('App\Models\Order','status_id','id');
    }
    public function province(){
        return $this->belongsTo('App\Models\Province','province_id');
    }
    public function district(){
        return $this->belongsTo('App\Models\District','district_id');
    }
    public function wards(){
        return $this->belongsTo('App\Models\Wards','wards_id');
    }
}
