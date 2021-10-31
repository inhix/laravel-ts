<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function getPost ($slug)
    {
        $post = DB::select('select * from posts where id = :id', ['id'=> $slug]);
        return view('posts.article', ['post'=>$post]);
    }
}
