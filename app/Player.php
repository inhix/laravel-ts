<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Player extends Model
{


    protected $fillable = ['name', 'nickname', 'image', 'player_description', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public static function add($fields)
    {
        $player = new static;
        $player->fill($fields);
        $player->save();

        return $player;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage()
    {
        if ($this->image != null) {
            Storage::delete('public/images/' . $this->image);
        }
    }

    public function uploadImage($image)
    {
        if ($image == null) {
            return;
        }

        $this->removeImage();
        $filename = $this->generateRandomString(10) . '.' . $image->extension();
        $image->storeAs('public/images', $filename);
        $this->image = $filename;
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

    public function getImage()
    {
        if ($this->image == null) {
            return '/img/no-image.png';
        }

        return '/storage/images/' . $this->image;

    }

    public function setCategory($id)
    {
        if ($id == null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function getCategoryTitle()
    {
        return ($this->category != null)
            ? $this->category->title
            : 'Нет категории';
    }

    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;
    }

    public function hasCategory()
    {
        return $this->category != null ? true : false;
    }

    public static function getPlayers()
    {
        return Player::inRandomOrder()->limit(5)->get();
    }

}
