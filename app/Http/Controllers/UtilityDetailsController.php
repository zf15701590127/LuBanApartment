<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityDetailsController extends Controller
{
    public function show()
    {
        return view('utilityDetails.show');
    }
}
