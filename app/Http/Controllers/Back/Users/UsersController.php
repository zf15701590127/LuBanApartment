<?php

namespace App\Http\Controllers\Back\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 后台编辑
    public function edit(User $user)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.users.users.create_and_edit', compact('user'));
    }

    // 后台用户更新
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('is_admin', Auth::user());

        $data = [];

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('back.users.users.index')->with('success', '个人资料更新成功！');
    }

    public function create(User $user)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.users.users.create_and_edit', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'avatar' => 'http://qiniu.baojiagongyu.xyz/05241946722924.jpg',
        ]);

        return redirect()->route('back.users.users.index')->with('success', '新增用户成功！');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        // 创建一个查询构造器
        $builder = User::query()->withTrashed();

        // 判断是否有提交 searchName 参数，如果有就赋值给 $searchName 变量
        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $users = $builder->paginate(10);

        return view('back.users.users.index', [
            'users' => $users,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function destroy(User $user)
    {
        $this->authorize('is_admin', Auth::user());

        $user->active = 0;
        $user->save();

        return redirect()->back()->with('success', '成功禁用用户！');
    }
}
