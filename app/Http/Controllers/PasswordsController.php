<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;

class PasswordsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();

        return view('passwords.edit', compact('user'));
    }

    public function update(PasswordRequest $request)
    {
        Auth::user()->update([
            'password' => Hash::make($request->password),
            'remember_toker' => Str::random(60),
        ]);

        session()->flash('success', '密码修改成功!');

        return redirect()->route('passwords.edit', Auth::id());
    }
}
