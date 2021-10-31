<?php

namespace App\Http\Controllers\Admin;

use App\Player;
use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();
        return view('admin.players.index', ['players' => $players]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.players.create', compact(
            'categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nickname' => 'required',
            'image' => 'nullable|image',
            'player_description' => 'required',
            'category_id' => 'required'
        ]);

        $player = Player::add($request->all());
        $player->uploadImage($request->file('image'));
        $player->setCategory($request->get('category_id'));

        return redirect()->route('players.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player::find($id);
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.players.edit', compact(
            'categories',
            'player'
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'nickname' => 'required',
            'image' => 'nullable|image',
            'player_description' => 'required',
            'category_id' => 'required'
        ]);

        $player = Player::find($id);
        $player->edit($request->all());
        $player->uploadImage($request->file('image'));
        $player->setCategory($request->get('category_id'));

        return redirect()->route('players.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->remove();
    }
}
