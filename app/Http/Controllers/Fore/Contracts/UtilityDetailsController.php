<?php

namespace App\Http\Controllers\Fore\Contracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UtilityDetailsController extends Controller
{
    public function show()
    {
        return view('fore.contracts.utilityDetails.show');
    }
}
