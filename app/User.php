<?php

namespace App;

use \Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const IS_BANNED = 1;
    const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',

    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields); //name,email

        $this->save();
    }

    public function generatePassword($password)
    {
        if ($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }

    public function uploadAvatar($image)
    {
        if ($image == null) {
            return;
        }

        $this->removeAvatar();

        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('public/images', $filename);
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar()
    {
        if ($this->avatar != null) {
            Storage::delete('public/images' . $this->avatar);
        }
    }

    public function getImage()
    {
        if ($this->avatar == null) {
            return '/img/no-image.png';
        }

        return '/storage/images/' . $this->avatar;
    }

    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }

    public function toggleBan($value)
    {
        if ($value == null) {
            return $this->unban();
        }

        return $this->ban();
    }

    public function roles()
    {
        return $this->hasOne(
            Role::class,
            'id',
            'role_id'
        );
    }

    public function resources()
    {
        return $this->belongsToMany(
            Resource::class,
            'roles_resources',
            'resource_id',
            'role_id'
        );
    }

    public function getUserResources()
    {
        $allowedUserResources = [];
        $collection = Role::with('resources')->get();
        $role = $collection->whereIn('id', $this->role_id)->first();
        foreach ($role->resources()->get() as $resource) {
            $attributes = $resource->attributesToArray();
            array_push($allowedUserResources, $attributes['title']);
        };
        return $allowedUserResources;
    }


}
