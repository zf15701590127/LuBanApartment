<?php

namespace App\Http\Controllers\Fore\Rooms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $rooms = Room::with(['contract', 'reserve'])->get();

        return view('fore.rooms.rooms.index', compact('rooms'));
    }

    // 修改正常房间状态为脏房状态
    public function dirtyStatusMark(Room $room)
    {
        if ($room->status_mark != 0) {
            return back()->with('danger', '操作出错，请联系管理员！');
        }

        $room->status_mark = 2;
        $room->save();

        return back();
    }

    // 修改脏房间状态改为正常状态
    public function cleanStatusMark(Room $room)
    {
        if ($room->status_mark != 2) {
            return back()->with('danger', '操作出错，请联系管理员！');
        }

        $room->status_mark = 0;
        $room->save();

        return back();
    }

    // 修改正常房间状态改为维修状态
    public function repairStatusMark(Room $room)
    {
        if ($room->status_mark != 0) {
            return back()->with('danger', '操作出错，请联系管理员！');
        }

        $room->status_mark = 1;
        $room->save();

        return back();
    }

    // 修改
    public function repairedStatusMark(Room $room)
    {
        if ($room->status_mark != 1) {
            return back()->with('danger', '操作出错，请联系管理员！');
        }

        $room->status_mark = 0;
        $room->save();

        return back();
    }

}
