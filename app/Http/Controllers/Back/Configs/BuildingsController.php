<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\BuildingRequest;
use App\Models\Building;
use Auth;

class BuildingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = Building::query()->with(['project']);

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $buildings = $builder->paginate(10);

        return view('back.configs.buildings.index', [
            'buildings' => $buildings,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(Building $building)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.buildings.create_and_edit', [
            'building' => $building
        ]);
    }

    public function store(BuildingRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        Building::create([
            'name' => $request->name,
            'order' => 1
        ]);

        return redirect()->route('back.configs.buildings.index');
    }

    public function edit(Building $building)
    {
        $this->authorize('is_admin', Auth::user());

        return view('back.configs.buildings.create_and_edit', compact('building'));
    }

    public function update(Building $building, BuildingRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $building->update($request->all());

        return redirect()->route('back.configs.buildings.index')->with('success', '修改成功！');
    }

    public function destroy(Building $building)
    {
        $this->authorize('is_admin', Auth::user());

        $building->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
