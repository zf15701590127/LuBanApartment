<?php

namespace App\Http\Controllers\Fore\Contracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractDetailsController extends Controller
{
    public function show()
    {
        return view('fore.contracts.contractDetails.show');
    }
}
