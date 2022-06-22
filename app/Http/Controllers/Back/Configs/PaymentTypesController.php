<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use App\Http\Requests\Back\PaymentTypeRequest;
use Illuminate\Http\Request;
use Auth;

class PaymentTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = PaymentType::query();

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $paymentTypes = $builder->paginate(10);

        return view('back.configs.paymentTypes.index', [
            'paymentTypes' => $paymentTypes,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(PaymentType $paymentType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.paymentTypes.create_and_edit', ['paymentType' => $paymentType]);
    }

    public function store(PaymentTypeRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        PaymentType::create($request->all());

        return redirect()->route('back.configs.paymentTypes.index')->with('success', '添加成功！');
    }

    public function edit(PaymentType $paymentType)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.paymentTypes.create_and_edit', ['paymentType' => $paymentType]);
    }

    public function update(PaymentTypeRequest $request, PaymentType $paymentType)
    {
        $this->authorize('is_admin', Auth::user());

        $paymentType->update($request->all());

        return redirect()->route('back.configs.paymentTypes.index')->with('success', '修改成功！');
    }

    public function destroy(PaymentType $paymentType)
    {
        $this->authorize('is_admin', Auth::user());

        $paymentType->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
