<?php

namespace App\Http\Controllers\Admin;

use App\Match;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::all();

        return view('admin.matches.index', ['matches' => $matches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.matches.create', compact(
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
            'category_id' => 'required',
            'opponent_name' => 'required',
            'opponent_logo' => 'required',
            'tournament' => 'required',
            'start_time' => 'required'
        ]);

        $match = Match::add($request->all());
        $match->uploadOpponentLogo($request->file('opponent_logo'));
        $match->setCategory($request->get('category_id'));

        return redirect()->route('matches.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $match = Match::find($id);
        $categories = Category::pluck('title', 'id')->all();

        return view('admin.matches.edit', compact(
            'categories',
            'match'
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
            'category_id' => 'required',
            'opponent_name' => 'required',
            'tournament' => 'required',
            'start_time' => 'required'
        ]);

        $match = Match::find($id);
        $match->edit($request->all());
        $match->uploadOpponentLogo($request->file('opponent_logo'));
        $match->setCategory($request->get('category_id'));

        return redirect()->route('matches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Match::find($id)->remove();
    }
}
