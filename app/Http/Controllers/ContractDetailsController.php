<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractDetailsController extends Controller
{
    public function show()
    {
        return view('contractDetails.show');
    }
}
