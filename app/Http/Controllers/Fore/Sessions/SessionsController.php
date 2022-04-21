<?php

namespace App\Http\Controllers\Fore\Sessions;

use Illuminate\Http\Request;
use App\Http\Requests\Fore\SessionRequest;
use App\Http\Controllers\Controller;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('fore.sessions.sessions.create');
    }

    public function store(SessionRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            // 登陆成功相关操作
            session()->flash('success', '欢迎回来！');
            return redirect()->route('fore.topics.topics.index');
        } else {
            // 登陆失败后的相关操作
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配!');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect()->route('fore.sessions.sessions.create');
    }
}
