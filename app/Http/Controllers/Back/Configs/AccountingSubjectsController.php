<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\AccountingSubjectRequest;
use Illuminate\Http\Request;
use App\Models\AccountingSubject;
use Auth;

class AccountingSubjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = AccountingSubject::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $accountingSubjects = $builder->paginate(10);

        return view('back.configs.accountingSubjects.index', [
            'accountingSubjects' => $accountingSubjects,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function create(AccountingSubject $accountingSubject)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.accountingSubjects.create_and_edit', compact('accountingSubject'));
    }

    public function store(AccountingSubjectRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        AccountingSubject::create($request->all());

        return redirect()->route('back.configs.accountingSubjects.index')->with('success', '添加成功！');
    }

    public function edit(AccountingSubject $accountingSubject)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.accountingSubjects.create_and_edit', ['accountingSubject' => $accountingSubject]);
    }

    public function update(AccountingSubjectRequest $request, AccountingSubject $accountingSubject)
    {
        $this->authorize('is_admin', Auth::user());

        $accountingSubject->update($request->all());

        return redirect()->route('back.configs.accountingSubjects.index')->with('success', '修改成功！');
    }

    public function destroy(AccountingSubject $accountingSubject)
    {
        $this->authorize('is_admin', Auth::user());

        $accountingSubject->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
