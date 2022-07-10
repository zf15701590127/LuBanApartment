<?php

namespace App\Http\Controllers\Fore\Reserves;

use App\Http\Controllers\Controller;
use App\Models\LeaseType;
use App\Models\User;
use App\Models\Room;
use App\Models\LeaseTerm;
use App\Models\DepositMonth;
use App\Models\MarketingChannel;
use App\Models\Reserve;
use App\Models\Project;
use App\Models\RoomCustomer;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Http\Requests\fore\ReserveRequest;

class ReservesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $leaseTypes = LeaseType::all();
        $users = User::all();
        $rooms = Room::all();
        $leaseTerms = LeaseTerm::all();
        $depositMonths = DepositMonth::all();
        $marketingChannels = MarketingChannel::all();
        $today = date('Y-m-d');
        $room_id = $request->room_id;

        return view('fore.reserves.reserves.create', [
            'leaseTypes' => $leaseTypes,
            'users' => $users,
            'rooms' => $rooms,
            'leaseTerms' => $leaseTerms,
            'depositMonths' => $depositMonths,
            'marketingChannels' => $marketingChannels,
            'today' => $today,
            'room_id' => $room_id
        ]);
    }

    public function store(ReserveRequest $request)
    {
        $room = Room::findOrFail($request->room_id);
        $begin_date = strtotime($request->begin_date);
        $end_date = strtotime($request->end_date);

        // 创建 room_customer
        $roomCustomer = [];
        $roomCustomer['project_id'] = $room->project_id;
        $roomCustomer['building_id'] = $room->building_id;
        $roomCustomer['room_id'] = $request->room_id;
        $roomCustomer['cold_water_read'] = 0;
        $roomCustomer['electric_read'] = 0;
        $roomCustomer['wallet'] = 0;
        $roomCustomer['first_begin_date'] =  $begin_date;
        $roomCustomer['begin_date'] =  $begin_date;
        $roomCustomer['end_date'] = $end_date;
        $roomCustomer['mobile_phone_number'] = $request->mobile_phone_number;
        $roomCustomer['name'] = $request->name;

        $roomCustomerId = RoomCustomer::insertGetId($roomCustomer);

        $reserve = [];
        $reserve['lease_type_id'] = $request->lease_type_id;
        $reserve['begin_date'] = $begin_date;
        $reserve['end_date'] = $end_date;
        $reserve['lease_term_id'] = $request->lease_term_id;
        $reserve['room_id'] = $request->room_id;
        $reserve['rent'] = $request->rent;
        $reserve['deposit_month_id'] = $request->deposit_month_id;
        $reserve['mobile_phone_number'] = $request->mobile_phone_number;
        $reserve['name'] = $request->name;
        $reserve['reserve_amount'] = $request->reserve_amount;
        $reserve['created_at'] = now();
        $reserve['project_id'] = $room->project_id;
        $reserve['reserve_status'] = 1; // 预定待支付
        $reserve['room_customer_id'] = $roomCustomerId;

        $reserve_id = Reserve::insertGetId($reserve);

        // 修改房间状态为预定状态
        $room->status_mark = 3;
        $room->reserve_id = $reserve_id;
        $room->save();

        return redirect()->route('fore.reserves.reserves.index')->with('success', '预定成功！');
    }

    public function index()
    {
        $builder = Reserve::query();

        $quantity = $builder->count();

        $reserves = $builder->paginate(10);

        $search = '';

        $paymentTypes = PaymentType::all();

        return view('fore.operations.reserves.index', [
            'reserves' => $reserves,
            'paymentTypes' => $paymentTypes,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function cancel(Reserve $reserve)
    {
        $room = Room::find($reserve->room_id);

        // 只有在预定为未支付 && 房间状态为预定才能正常取消
        if ($reserve->reserve_status == 1 && $room->status_mark == 3) {

            $reserve->reserve_status = 4;
            $reserve->save();

            $room->status_mark = 0;
            $room->save();

            return back()->with('success', '预定已成功取消！');

        } else {

            return back()->with('danger', '数据异常请联系管理员！');
        }

    }
}
