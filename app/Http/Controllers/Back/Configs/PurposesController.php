<?php

namespace App\Http\Controllers\back\configs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\PurposeRequest;
use Illuminate\Http\Request;
use App\Models\Purpose;
use Auth;

class PurposesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = Purpose::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $purposes = $builder->paginate(10);

        return view('back.configs.purposes.index', [
            'purposes' => $purposes,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(Purpose $purpose)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.purposes.create_and_edit', ['purpose' => $purpose]);
    }

    public function store(PurposeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        Purpose::create($request->all());

        return redirect()->route('back.configs.purposes.index')->with('success', '添加成功！');
    }

    public function edit(Purpose $purpose)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.purposes.create_and_edit', ['purpose' => $purpose]);
    }

    public function update(Purpose $purpose, PurposeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $purpose->update($request->all());

        return redirect()->route('back.configs.purposes.index')->with('success', '修改成功！');
    }

    public function destroy(Purpose $purpose)
    {
        $this->authorize('is_admin', Auth::user());

        $purpose->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
