<?php

namespace App\Http\Controllers\Back\Configs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DepositMonth;
use App\Http\Requests\Back\DepositMonthRequest;
use Auth;

class DepositMonthsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = DepositMonth::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $depositMonths = $builder->paginate(10);

        return view('back.configs.depositMonths.index', [
            'depositMonths' => $depositMonths,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(DepositMonth $depositMonth)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.depositMonths.create_and_edit', ['depositMonth' => $depositMonth]);
    }

    public function store(DepositMonthRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        DepositMonth::create($request->all());

        return redirect()->route('back.configs.depositMonths.index')->with('success', '添加成功！');
    }

    public function edit(DepositMonth $depositMonth)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.depositMonths.create_and_edit', ['depositMonth' => $depositMonth]);
    }

    public function update(DepositMonth $depositMonth, DepositMonthRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $depositMonth->update($request->all());

        return redirect()->route('back.configs.depositMonths.index')->with('success', '修改成功！');
    }

    public function destroy(DepositMonth $depositMonth)
    {
        $this->authorize('is_admin', Auth::user());

        $depositMonth->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
