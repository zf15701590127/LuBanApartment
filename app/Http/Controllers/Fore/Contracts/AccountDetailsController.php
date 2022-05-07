<?php

namespace App\Http\Controllers\Fore\Contracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('fore.contracts.accountDetails.show');
    }
}
