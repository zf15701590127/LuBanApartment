<?php

namespace App\Http\Controllers\Fore\Contracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\RoomCustomer;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($room_customer_id)
    {
        // 订单详情
        $orders = Order::where('room_customer_id', $room_customer_id)->paginate(13);

        // 支付方式
        $paymentTypes = PaymentType::all();

        // room_customer 详情
        $roomCustomer = RoomCustomer::where('id', $room_customer_id)->firstOrFail();

        return view('fore.contracts.orders.show', [
            'orders' => $orders,
            'roomCustomer' => $roomCustomer,
            'paymentTypes' => $paymentTypes,
        ]);
    }
}
