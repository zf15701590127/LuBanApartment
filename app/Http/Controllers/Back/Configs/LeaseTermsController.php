<?php

namespace App\Http\Controllers\Back\Configs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Back\LeaseTermRequest;
use App\Models\LeaseTerm;
use Auth;

class LeaseTermsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = LeaseTerm::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $leaseTerms = $builder->paginate(10);

        return view('back.configs.leaseTerms.index', [
            'leaseTerms' => $leaseTerms,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(LeaseTerm $leaseTerm)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.leaseTerms.create_and_edit', ['leaseTerm' => $leaseTerm]);
    }

    public function store(LeaseTermRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        LeaseTerm::create($request->all());

        return redirect()->route('back.configs.leaseTerms.index')->with('success', '添加成功！');
    }

    public function edit(LeaseTerm $leaseTerm)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.leaseTerms.create_and_edit', ['leaseTerm' => $leaseTerm]);
    }

    public function update(LeaseTerm $leaseTerm, LeaseTermRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $leaseTerm->update($request->all());

        return redirect()->route('back.configs.leaseTerms.index')->with('success', '修改成功！');
    }

    public function destroy(LeaseTerm $leaseTerm)
    {
        $this->authorize('is_admin', Auth::user());

        $leaseTerm->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
