<?php

namespace App\Http\Controllers\Fore\Rooms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomsController extends Controller
{
    public function index()
    {
        return view('fore.rooms.rooms.index');
    }
}
