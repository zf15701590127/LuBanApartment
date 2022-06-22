<?php

namespace App\Http\Controllers\Back\Configs;

use Illuminate\Http\Request;
use App\Http\Requests\Back\CertificateTypeRequest;
use App\Http\Controllers\Controller;
use App\Models\CertificateType;
use Auth;

class CertificateTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = CertificateType::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $certificateTypes = $builder->paginate(10);

        return view('back.configs.certificateTypes.index', [
            'certificateTypes' => $certificateTypes,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(CertificateType $certificateType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.certificateTypes.create_and_edit', ['certificateType' => $certificateType]);
    }

    public function store(CertificateTypeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        CertificateType::create($request->all());

        return redirect()->route('back.configs.certificateTypes.index')->with('success', '添加成功！');
    }

    public function edit(CertificateType $certificateType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.certificateTypes.create_and_edit', ['certificateType' => $certificateType]);
    }

    public function update(CertificateType $certificateType, CertificateTypeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $certificateType->update($request->all());

        return redirect()->route('back.configs.certificateTypes.index')->with('success', '修改成功！');
    }

    public function destroy(CertificateType $certificateType)
    {
        $this->authorize('is_admin', Auth::user());

        $certificateType->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}

