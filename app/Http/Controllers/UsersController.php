<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // 前台用户编辑
    public function foreUsersEdit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.foreUsersEdit', compact('user'));
    }

    // 前台用户更新
    public function foreUsersUpdate(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->only(['email', 'avatar']);

        if($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }

    public function index()
    {
        $users = User::withTrashed()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create(User $user)
    {
        return view('users.backCreate_and_backEdit', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', '新增用户成功！');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return redirect()->route('users.index');
    }
}
