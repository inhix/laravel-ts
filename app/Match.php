<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;


class Match extends Model
{

    protected $fillable = ['category_id', 'score', 'opponent_name', 'opponent_logo', 'tournament', 'start_time'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function add($fields)
    {
        $match = new static;
        $match->fill($fields);
        $match->save();

        return $match;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeOpponentLogo();
        $this->delete();
    }

    public function removeOpponentLogo()
    {
        if ($this->opponent_logo != null) {
            Storage::delete('public/images/' . $this->opponent_logo);
        }
    }

    public function uploadOpponentLogo($image)
    {
        if ($image == null) {
            return;
        }

        $this->removeOpponentLogo();
        $filename = $this->generateRandomString(10) . '.' . $image->extension();
        $image->storeAs('public/images', $filename);
        $this->opponent_logo = $filename;
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


    public function getOpponentLogo()
    {
        if ($this->opponent_logo == null) {
            return '/img/no-image.png';
        }

        return '/storage/images/' . $this->opponent_logo;

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

    public function getCategoryIcon()
    {
        return ($this->category != null)
            ? $this->category->icon
            : 'Нет категории';
    }

    public function getCategoryID()
    {
        return ($this->category != null)
            ? $this->category->title
            : 'Нет категории';
    }


    public function getDate()
    {
        return Carbon::createFromFormat('d/m/y', $this->start_time)->format('F d, Y G:i');
    }

    public function hasCategory()
    {
        return $this->category != null ? true : false;
    }

    public static function upcomingMatches()
    {
        return self::where('score', NULL)->orderBy('start_time')->get();
    }

    public static function previousMatches()
    {
        return self::whereNotNull('score')->orderBy('start_time', 'desc')->get();
    }

    public static function upcomingMatchesIndex()
    {
        return self::where('score', NULL)->orderBy('start_time')->take(3)->get();
    }

    public static function previousMatchesIndex()
    {
        return self::whereNotNull('score')->orderBy('start_time', 'desc')->take(7)->get();
    }
}
