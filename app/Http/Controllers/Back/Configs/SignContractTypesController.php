<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\SignContractTypeRequest;
use App\Models\SignContractType;
use Auth;

class SignContractTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = SignContractType::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $signContractTypes = $builder->paginate(10);

        return view('back.configs.signContractTypes.index', [
            'signContractTypes' => $signContractTypes,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(SignContractType $signContractType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.signContractTypes.create_and_edit', ['signContractType' => $signContractType]);
    }

    public function store(SignContractTypeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        SignContractType::create($request->all());

        return redirect()->route('back.configs.signContractTypes.index')->with('success', '添加成功！');
    }

    public function edit(SignContractType $signContractType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.signContractTypes.create_and_edit', ['signContractType' => $signContractType]);
    }

    public function update(SignContractTypeRequest $request, SignContractType $signContractType)
    {
        $this->authorize('is_admin', Auth::user());

        $signContractType->update($request->all());

        return redirect()->route('back.configs.signContractTypes.index')->with('success', '修改成功！');
    }

    public function destroy(SignContractType $signContractType)
    {
        $this->authorize('is_admin', Auth::user());

        $signContractType->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
