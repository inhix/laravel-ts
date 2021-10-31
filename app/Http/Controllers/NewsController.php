<?php

namespace App\Http\Controllers;

use App\Match;
use App\Player;
use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('date', 'desc')->get();
        return view('news.index', [
            'posts' => $posts
        ]);
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $latestNews = Post::latestNews();
        return view('news.post', [
            'latestNews' => $latestNews,
            'post' => $post
        ]);
    }

}
