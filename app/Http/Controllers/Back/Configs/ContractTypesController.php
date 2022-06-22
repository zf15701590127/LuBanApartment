<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\ContractTypeRequest;
use Illuminate\Http\Request;
use App\Models\ContractType;
use Auth;

class ContractTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = ContractType::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $contractTypes = $builder->paginate(10);

        return view('back.configs.contractTypes.index', [
            'contractTypes' => $contractTypes,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(ContractType $contractType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.contractTypes.create_and_edit', ['contractType' => $contractType]);
    }

    public function store(ContractTypeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        ContractType::create($request->all());

        return redirect()->route('back.configs.contractTypes.index')->with('success', '添加成功！');
    }

    public function edit(ContractType $contractType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.contractTypes.create_and_edit', ['contractType' => $contractType]);
    }

    public function update(ContractTypeRequest $request, ContractType $contractType)
    {
        $this->authorize('is_admin', Auth::user());

        $contractType->update($request->all());

        return redirect()->route('back.configs.contractTypes.index')->with('success', '修改成功！');
    }

    public function destroy(ContractType $contractType)
    {
        $this->authorize('is_admin', Auth::user());

        $contractType->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
