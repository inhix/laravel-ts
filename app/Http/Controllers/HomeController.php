<?php

namespace App\Http\Controllers;

use App\Match;
use App\Player;
use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $players = Player::getPlayers();
        $latestNews = Post::latestNews();
        $upcomingMatches = Match::upcomingMatchesIndex();
        $previousMatches = Match::previousMatchesIndex();
        return view('index', [
            'players' => $players,
            'upcomingMatches' => $upcomingMatches,
            'previousMatches' => $previousMatches,
            'latestNews' => $latestNews]);
    }
}
