<?php

namespace App\Http\Controllers;

use App\Match;
use App\Player;
use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchesController extends Controller
{
    public function index()
    {
        $upcomingMatches = Match::upcomingMatches();
        $previousMatches = Match::previousMatches();
        return view('matches.index', [
            'upcomingMatches' => $upcomingMatches,
            'previousMatches' => $previousMatches
        ]);
    }

    public function show($id)
    {
        $match = Match::where('id', $id)->firstOrFail();

        return view('matches.match', compact('match'));
    }

    public function tag($id)
    {
        $tag = Tag::where('id', $id)->firstOrFail();

        $posts = $tag->posts()->paginate(2);

        return view('pages.list', ['posts' => $posts]);
    }

    public function category($id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        $posts = $category->posts()->paginate(2);

        return view('pages.list', ['posts' => $posts]);
    }
}
