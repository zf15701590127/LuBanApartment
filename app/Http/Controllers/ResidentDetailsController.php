<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResidentDetailsController extends Controller
{
    public function show()
    {
        return view('residentDetails.show');
    }
}
