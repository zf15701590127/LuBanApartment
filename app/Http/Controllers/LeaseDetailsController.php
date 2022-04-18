<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaseDetailsController extends Controller
{
    public function show()
    {
        return view('leaseDetails.show');
    }
}
