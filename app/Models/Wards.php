<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];
    protected $primaryKey = 'wards_id';
    protected $table = 'wards';
}
