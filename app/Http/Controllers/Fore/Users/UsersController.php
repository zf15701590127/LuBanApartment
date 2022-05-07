<?php

namespace App\Http\Controllers\Fore\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fore\UserRequest;
use App\Models\User;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user)
    {
        return view('fore.users.users.show', compact('user'));
    }

    // 前台用户编辑
    public function edit(User $user)
    {
        $this->authorize('foreUpdate', $user);

        return view('fore.users.users.edit', compact('user'));
    }

    // 前台用户更新
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('foreUpdate', $user);

        $data = $request->only(['email', 'avatar']);

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('fore.users.users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
