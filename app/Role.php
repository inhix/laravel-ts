<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title'];

    public function resources()
    {
        return $this->belongsToMany(
            Resource::class,
            'roles_resources',
            'resource_id',
            'role_id'
        );
    }


}
