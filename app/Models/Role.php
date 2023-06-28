<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    function permissions(){
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
    public function users(){
        return $this->BelongsToMany(Role::class, 'user_role');
    }
}
