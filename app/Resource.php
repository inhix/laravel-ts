<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{

    protected $fillable = ['title'];

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'roles_resources',
            'resource_id',
            'role_id'
        );
    }

    public static function getResources()
    {
        $aclResources = [];
        foreach (Resource::all() as $aclItem) {
            $aclResource = $aclItem->attributesToArray();
            array_push($aclResources, $aclResource['title']);
        }
        return $aclResources;
    }

}
