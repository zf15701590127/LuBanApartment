<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomManagementsController extends Controller
{
    public function index()
    {
        return view('roomManagements.index');
    }
}
