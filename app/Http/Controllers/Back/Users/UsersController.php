<?php

namespace App\Http\Controllers\Back\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 后台编辑
    public function edit(User $user)
    {
        return view('back.users.users.create_and_edit', compact('user'));
    }

    // 后台用户更新
    public function update(UserRequest $request, User $user)
    {
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
        return view('back.users.users.create_and_edit', compact('user'));
    }

    public function store(UserRequest $request)
    {
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
        // 创建一个查询构造器
        $userBuilder = User::query()->withTrashed();

        // 判断是否有提交 searchName 参数，如果有就赋值给 $searchName 变量
        if ($search = $request->input('name', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $userBuilder->where('name', 'like', $like);
        }

        $userQuantity = $userBuilder->count();

        $users = $userBuilder->paginate(10);

        return view('back.users.users.index', [
            'users' => $users,
            'userQuantity' => $userQuantity,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function destroy(User $user)
    {
        $user->active = 0;
        $user->save();

        session()->flash('success', '成功禁用用户！');

        return redirect()->back();
    }
}
