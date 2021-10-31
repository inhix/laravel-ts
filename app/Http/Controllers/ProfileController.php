<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::user()->id),
            ],
            'avatar' => 'nullable|image'
        ]);

        $user = Auth::user();
        $user->edit($request->all());
        $user->generatePassword($request->get('password'));
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->back()->with('status', 'Профиль успешно обновлен');
    }

    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view('pages.profileEdit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'avatar' => 'nullable|image'
        ]);

        $user->edit($request->all()); //name,email
        $user->uploadAvatar($request->file('avatar'));

        return redirect()->route('profile.index');
    }


    public function passwordEdit()
    {
        $user = Auth::user();
        return view('auth.passwords.reset', compact('user'));
    }

    public function passwordUpdate(Request $request, $id)
    {
        $user = Auth::user();

        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);

        dd($request['password']);
        $user->password = Hash::make($request['password']);

        $user->save();

        return redirect()->route('profile.index');
    }
}
