<?php

namespace App\Http\Controllers\Fore\Contracts;

use Illuminate\Http\Request;
use App\Http\Requests\Fore\ContractRequest;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\LeaseType;
use App\Models\ContractType;
use App\Models\CertificateType;
use App\Models\SignContractType;
use App\Models\User;
use App\Models\Room;
use App\Models\LeaseTerm;
use App\Models\DepositMonth;
use App\Models\MarketingChannel;
use App\Models\RoomCustomer;
use App\Models\Order;
use App\Models\ContractCustomer;
use Carbon\Carbon;

class ContractsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($room_customer_id)
    {
        $contracts = Contract::where('room_customer_id', $room_customer_id)->get();

        $roomCustomer = RoomCustomer::where('id', $room_customer_id)->firstOrFail();


        return view('fore.contracts.contracts.show', [
            'contracts' => $contracts,
            'roomCustomer' => $roomCustomer,
        ]);
    }

    public function create()
    {
        $leaseTypes = LeaseType::all();
        $contractTypes = ContractType::all();
        $certificateTypes = CertificateType::all();
        $signContractTypes = SignContractType::all();
        $users = User::all();
        $rooms = Room::all();
        $leaseTerms = LeaseTerm::all();
        $depositMonths = DepositMonth::all();
        $marketingChannels = MarketingChannel::all();
        $today = date('Y-m-d');

        return view('fore.contracts.contracts.create', [
            'leaseTypes' => $leaseTypes,
            'contractTypes' => $contractTypes,
            'certificateTypes' => $certificateTypes,
            'signContractTypes' => $signContractTypes,
            'users' => $users,
            'rooms' => $rooms,
            'leaseTerms' => $leaseTerms,
            'depositMonths' => $depositMonths,
            'marketingChannels' => $marketingChannels,
            'today' => $today,
        ]);
    }

    public function store(ContractRequest $request, Contract $contract)
    {
        // 处理开始时间和结束时间成时间戳
        $begin_date = strtotime($request->begin_date);
        $end_date = strtotime($request->end_date);

        // 获取房间的项目 ID project_id、楼栋 ID building_id
        $room = Room::find($request->room_id);

        // 首先创建 room_customer 记录
        $roomCustomer = [];
        $roomCustomer['project_id'] = $room->project_id;
        $roomCustomer['building_id'] = $room->building_id;
        $roomCustomer['room_id'] = $request->room_id;
        $roomCustomer['contract_type_id'] = 1; // 直接签约
        $roomCustomer['cold_water_read'] = 0;
        $roomCustomer['electric_read'] = 0;
        $roomCustomer['wallet'] = 0;
        $roomCustomer['first_begin_date'] = $begin_date;
        $roomCustomer['begin_date'] = $begin_date;
        $roomCustomer['end_date'] = $end_date;
        $roomCustomer['pay_status'] = 2;
        $roomCustomer['mobile_phone_number'] = $request->mobile_phone_number;
        $roomCustomer['name'] = $request->customer_name;

        $room_customer_id = RoomCustomer::insertGetId($roomCustomer);

        // 创建 contractCustomer 记录
        $contractCustomer = [];
        $contractCustomer['name'] = $request->customer_name;
        $contractCustomer['room_customer_id'] = $room_customer_id;
        $contractCustomer['is_contractor'] = 1;
        $contractCustomer['certificate_type_id'] = $request->certificate_type_id;
        $contractCustomer['certificate_no'] = $request->certificate_no;
        $contractCustomer['sex'] = (substr($request->certificate_no, (strlen($request->certificate_no) == 15 ? -1 : -2), 1) % 2) == 0 ? 2 : 1;
        $contractCustomer['mobile_phone_number'] = $request->mobile_phone_number;
        $contractCustomer['project_id'] = $room->project_id;
        $contractCustomer['room_id'] = $request->room_id;
        $contractCustomer['created_at'] = date('Y-m-d H:i:s');


        $contract_customer_id = ContractCustomer::insertGetId($contractCustomer);

        // 创建合同记录
        $contract = [];
        $contract['room_customer_id'] = $room_customer_id;
        $contract['project_id'] = $room->project_id;
        $contract['building_id'] = $room->building_id;
        $contract['room_id'] = $request->room_id;
        $contract['lease_type_id'] = $request->lease_type_id;
        $contract['sign_contract_type_id'] = $request->sign_contract_type_id;
        $contract['contract_type_id'] = 1; // 直接签约
        $contract['user_id'] = $request->user_id;
        $contract['marketing_channel_id'] = $request->marketing_channel_id;
        $contract['begin_date'] = $begin_date;
        $contract['end_date'] = $end_date;
        $contract['actual_end_date'] = 0;
        $contract['lease_term_id'] = $request->lease_term_id;
        $contract['deposit_month_id'] = $request->deposit_month_id;
        $contract['deposit_amount'] = $request->rent;
        $contract['rent'] = $request->rent;
        $contract['contract_customer_id'] = $contract_customer_id;
        $contract['cold_water_read'] = 0;
        $contract['electric_read'] = 0;
        $contract['period_type'] = $request->period_type;
        $contract['created_at'] = date('Y-m-d H:i:s');

        $contract_id = Contract::insertGetId($contract);

        // 获取 Lease_Terms 对应的 number
        $lease_term = LeaseTerm::find($request->lease_term_id);
        $order = [];

        // 创建账单
        for ($i = 0; $i < $lease_term['number']; $i ++) {
            // 如果是第一期添加一期押金
            if ($i == 0) {
                $order[$i]['accounting_subject_id'] = 1;
                $order[$i]['is_must_pay'] = 1;
                $order[$i]['begin_date'] = $begin_date;
                $order[$i]['end_date'] = $end_date;
                $order[$i]['room_customer_id'] = $room_customer_id;
                $order[$i]['contract_id'] = $contract_id;
                $order[$i]['including_tax_price'] = $request->rent;
                $order[$i]['paid_amount'] = 0;
                $order[$i]['unpaid_amount'] = $request->rent;
                $order[$i]['tax_amount'] = 0;
                $order[$i]['tax_rate'] = 0;
                $order[$i]['is_visible'] = 1;
                $order[$i]['project_id'] = $room->project_id;
                $order[$i]['excluding_tax_price'] = 0;
                $order[$i]['pay_status'] = 2;
                $order[$i]['payment_id'] = 0;
                $order[$i]['room_id'] = $request->room_id;

            }

            // 特殊处理 31号，1号，其他的都是结束日期是开始日期的前一天
            if (date('d', $begin_date) == 1) {
                // 计算账单的结束时间
                $order_begin_date = Carbon::createFromTimestamp($begin_date)->addMonths($i)->timestamp;
                $order_end_date = Carbon::createFromTimestamp($begin_date)->addMonths($i)->lastOfMonth()->timestamp;

            } elseif (date('d', $begin_date) == 31) {
                // 计算账单的结束时间
                $order_begin_date = Carbon::createFromTimestamp($begin_date)->settings(['monthOverflow' => false])->addMonths($i)->timestamp;
                $order_end_date = Carbon::createFromTimestamp($begin_date)->settings(['monthOverflow' => false])->addMonths($i+1)->lastOfMonth()->subDay()->timestamp;

            } else {
                // 计算账单的开始和结束时间
                $order_begin_date = Carbon::createFromTimestamp($begin_date)->settings(['monthOverflow' => false])->addMonths($i)->timestamp;
                $order_end_date = Carbon::createFromTimestamp($begin_date)->settings(['monthOverflow' => false])->addmonths($i+1)->subDay()->timestamp;

            }

            $key = $i+1;
            $order[$key]['accounting_subject_id'] = 2;
            $order[$key]['is_must_pay'] = 0;
            $order[$key]['begin_date'] = $order_begin_date;
            $order[$key]['end_date'] = $order_end_date;
            $order[$key]['room_customer_id'] = $room_customer_id;
            $order[$key]['contract_id'] = $contract_id;
            $order[$key]['including_tax_price'] = $request->rent;
            $order[$key]['paid_amount'] = 0;
            $order[$key]['unpaid_amount'] = $request->rent;
            $order[$key]['tax_amount'] = 0;
            $order[$key]['tax_rate'] = 0;
            $order[$key]['is_visible'] = 1;
            $order[$key]['project_id'] = $room->project_id;
            $order[$key]['excluding_tax_price'] = 0;
            $order[$key]['pay_status'] = 2;
            $order[$key]['payment_id'] = 0;
            $order[$key]['room_id'] = $request->room_id;

        }

        Order::insert($order);

        return redirect()->route('fore.contracts.orders.show', $room_customer_id);

    }
}
