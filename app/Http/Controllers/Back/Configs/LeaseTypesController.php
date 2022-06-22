<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\LeaseTypeRequest;
use Illuminate\Http\Request;
use App\Models\LeaseType;
use Auth;

class LeaseTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = LeaseType::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $leaseTypes = $builder->paginate(10);

        return view('back.configs.leaseTypes.index', [
            'leaseTypes' => $leaseTypes,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(LeaseType $leaseType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.leaseTypes.create_and_edit', ['leaseType' => $leaseType]);
    }

    public function store(LeaseTypeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        LeaseType::create($request->all());

        return redirect()->route('back.configs.LeaseTypes.index')->with('success', '添加成功！');
    }

    public function edit(LeaseType $leaseType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.leaseTypes.create_and_edit', ['leaseType' => $leaseType]);
    }

    public function update(LeaseTypeRequest $request, LeaseType $leaseType)
    {
        $this->authorize('is_admin', Auth::user());

        $leaseType->update($request->all());

        return redirect()->route('back.configs.leaseTypes.index')->with('success', '修改成功！');
    }

    public function destroy(LeaseType $leaseType)
    {
        $this->authorize('is_admin', Auth::user());

        $leaseType->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
