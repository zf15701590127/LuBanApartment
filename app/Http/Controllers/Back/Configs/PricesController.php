<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\PriceRequest;
use App\Models\Price;
use App\Models\Project;
use Auth;

class PricesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = Price::query()->with(['project']);

        if ($project_id = $request->input('project_id', '')) {
            $builder->where('project_id', $project_id);
        }

        $quantity = $builder->count();

        $prices = $builder->paginate(10);

        $projects = Project::all();

        return view('back.configs.prices.index', [
            'prices' => $prices,
            'projects' => $projects,
            'quantity' => $quantity,
            'filters' => [
                'project_id' => $project_id,
            ]
        ]);
    }

    public function create(Price $price)
    {
        $this->authorize('is_admin', Auth::user());

        $projects =Project::all();

        return view('back.configs.prices.create_and_edit', [
            'price' => $price,
            'projects' => $projects,
        ]);
    }

    public function store(PriceRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        Price::create($request->all());

        return redirect()->route('back.configs.prices.index')->with('success', '添加成功!');
    }

    public function edit(Price $price)
    {
        $this->authorize('is_admin', Auth::user());

        $projects = Project::all();

        return view('back.configs.prices.create_and_edit', [
            'price' => $price,
            'projects' => $projects,
        ]);
    }

    public function update(Price $price, PriceRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $price->update($request->all());

        return redirect()->route('back.configs.prices.index')->with('success', '修改成功！');
    }

    public function destroy(Price $price)
    {
        $this->authorize('is_admin', Auth::user());

        $price->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
