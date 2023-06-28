<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function status()
    {
        return $this->belongsTo('App\Models\Status','status_id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    public function products(){
        return $this->belongsToMany('App\Models\Product','order_products','order_id','product_id');
    }
}
