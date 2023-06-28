<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    function CategoryChilren() {
        return $this->hasMany('App\Models\Category','parent_id')->where('status','1');
    }
    function products(){
        return $this->hasMany('App\Models\Product','category_id','id')->where('status','1');
    }
    function productsParent(){
        return $this->hasMany('App\Models\Product','category_id','parent_id')->where('status','1');
    }
}
