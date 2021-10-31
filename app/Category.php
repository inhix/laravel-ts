<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{

    protected $fillable = ['title', 'name'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function removeIcon()
    {
        if ($this->icon != null) {
            Storage::delete('public/images/' . $this->image);
        }
    }

    public function uploadIcon($icon)
    {
        if ($icon == null) {
            return;
        }

        $this->removeIcon();
        $filename = $this->generateRandomString(10) . '.' . $icon->extension();
        $icon->storeAs('public/images', $filename);
        $this->icon = $filename;
        $this->save();
    }

    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getIcon()
    {
        if ($this->icon == null) {
            return '/img/no-image.png';
        }

        return '/storage/images/' . $this->icon;

    }
}
