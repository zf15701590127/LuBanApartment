<?php

namespace App\Http\Controllers\Fore\Contracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomCustomer;
use App\Models\ContractCustomer;

class LeasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($room_customer_id)
    {
        $roomCustomer = RoomCustomer::where('id', $room_customer_id)->firstOrFail();
        $contractCustomer = ContractCustomer::where('room_customer_id', $room_customer_id)->firstOrFail();

        return view('fore.contracts.leases.show', [
            'roomCustomer' => $roomCustomer,
            'room_customer_id' => $room_customer_id,
            'contractCustomer' => $contractCustomer,
        ]);
    }
}
