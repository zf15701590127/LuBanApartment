<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountDetailsController extends Controller
{
    public function show()
    {
        return view('accountDetails.show');
    }
}
