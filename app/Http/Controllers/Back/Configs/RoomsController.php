<?php

namespace App\Http\Controllers\Back\Configs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Back\RoomRequest;
use App\Models\Room;
use App\Models\Project;
use App\Models\Purpose;
use App\Models\Building;
use Auth;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('is_admin', Auth::user());

        $builder = Room::query()->with(['building', 'purpose', 'project']);

        if ($search = $request->input('search', '')) {
            $like = '%' .$search. '%';
            // 模糊搜索
            $builder->where('name', 'like', $like);
        }

        $quantity = $builder->count();

        $rooms = $builder->paginate(10);

        return view('back.configs.rooms.index', [
            'rooms' => $rooms,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function create(Room $room)
    {
        $this->authorize('is_admin', Auth::user());

        $projects =Project::all();
        $buildings = Building::all();
        $purposes = Purpose::all();

        return view('back.configs.rooms.create_and_edit', [
            'room' => $room,
            'projects' => $projects,
            'purposes' => $purposes,
            'buildings' => $buildings,
        ]);
    }

    public function store(RoomRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        Room::create($request->all());

        return redirect()->route('back.configs.rooms.index')->with('success', '添加成功!');
    }

    public function edit(Room $room)
    {
        $this->authorize('is_admin', Auth::user());

        $projects =Project::all();
        $buildings = Building::all();
        $purposes = Purpose::all();

        return view('back.configs.rooms.create_and_edit', [
            'room' => $room,
            'projects' => $projects,
            'buildings' => $buildings,
            'purposes' => $purposes
        ]);
    }

    public function update(Room $room, RoomRequest $request)
    {
        $this->authorize('is_admin', Auth::user());

        $room->update($request->all());

        return redirect()->route('back.configs.rooms.index')->with('success', '修改成功！');
    }

    public function destroy(Room $room)
    {
        $this->authorize('is_admin', Auth::user());

        $room->delete();

        return redirect()->back()->with('success', '删除成功！');

    }
}

