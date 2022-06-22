<?php

namespace App\Http\Controllers\Fore\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\Fore\PaymentRequest;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment(Order $order, PaymentRequest $request)
    {
        dd(123);
    }
}
