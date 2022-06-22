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
        $rooms = Room::all();

        return view('fore.rooms.rooms.index', compact('rooms'));
    }

}
