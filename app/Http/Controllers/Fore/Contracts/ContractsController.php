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
use App\Models\Reserve;
use App\Models\ContractCustomer;
use App\Models\Payment;
use App\Models\Bill;
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

    public function create(Request $request, Reserve $reserve)
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
        $roomId = $request->room_id ? $request->room_id : '';
        if ($request->reserve_id) {
            $reserve = Reserve::findOrFail($request->reserve_id);
        }

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
            'room_id' => $roomId,
            'reserve' => $reserve,
        ]);
    }

    public function store(ContractRequest $request)
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
        $roomCustomer['cold_water_read'] = $request->cold_water_read;
        $roomCustomer['electric_read'] = $request->electric_read;
        $roomCustomer['wallet'] = 0;
        $roomCustomer['first_begin_date'] = $begin_date;
        $roomCustomer['begin_date'] = $begin_date;
        $roomCustomer['end_date'] = $end_date;
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
        $contract['cold_water_read'] = $request->cold_water_read;
        $contract['electric_read'] = $request->electric_read;
        $contract['period_type'] = $request->period_type;
        $contract['created_at'] = date('Y-m-d H:i:s');
        $contract['recent_due_date'] = $begin_date;
        $contract['remark'] = '';
        $contract['reserve_id'] = 0;

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
                $order[$i]['due_date'] = $begin_date;
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
            $order[$key]['due_date'] = $order_begin_date;
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

        // 更新房间状态变成已出租，并更新合同 ID 字段
        Room::find($request->room_id)->update([
            'status_mark' => 4, // 已出租
            'contract_id' => $contract_id,
        ]);

        return redirect()->route('fore.contracts.orders.show', $room_customer_id);

    }

    public function index()
    {
        $builder = Contract::query();

        $quantity = $builder->count();

        $contracts = $builder->paginate(10);

        $search = '';

        return view('fore.operations.contracts.index', [
            'contracts' => $contracts,
            'quantity' => $quantity,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function reserveTransformContract(ContractRequest $request)
    {
         // 处理开始时间和结束时间成时间戳
         $begin_date = strtotime($request->begin_date);
         $end_date = strtotime($request->end_date);

         // 获取房间的项目 ID project_id、楼栋 ID building_id
         $room = Room::find($request->room_id);

         // 更新 roomCustomer
         $reserve = Reserve::find($request->reserve_id);
         $room_customer_id = $reserve->room_customer_id;

         $roomCustomer = RoomCustomer::findOrFail($room_customer_id);
         $roomCustomer->project_id = $room->project_id;
         $roomCustomer->building_id = $room->building_id;
         $roomCustomer->room_id = $request->room_id;
         $roomCustomer->cold_water_read = $request->cold_water_read;
         $roomCustomer->electric_read = $request->electric_read;
         $roomCustomer->wallet = 0;
         $roomCustomer->first_begin_date = $begin_date;
         $roomCustomer->begin_date = $begin_date;
         $roomCustomer->end_date = $end_date;
         $roomCustomer->mobile_phone_number = $request->mobile_phone_number;
         $roomCustomer->name = $request->customer_name;
         $roomCustomer->save();

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
         $contract['cold_water_read'] = $request->cold_water_read;
         $contract['electric_read'] = $request->electric_read;
         $contract['period_type'] = $request->period_type;
         $contract['created_at'] = date('Y-m-d H:i:s');
         $contract['recent_due_date'] = $begin_date;
         $contract['remark'] = '';
         $contract['reserve_id'] = 0;

         $contract_id = Contract::insertGetId($contract);

         // 获取 Lease_Terms 对应的 number
         $lease_term = LeaseTerm::find($request->lease_term_id);


         // 创建定金账单
         $deposit_order = [
            'accounting_subject_id' => 1,
            'is_must_pay' => 1,
            'begin_date' => $begin_date,
            'end_date' => $end_date,
            'due_date' => $begin_date,
            'room_customer_id' => $room_customer_id,
            'contract_id' => $contract_id,
            'including_tax_price' => $request->rent,
            'paid_amount' => 0,
            'unpaid_amount' => $request->rent,
            'tax_amount' => 0,
            'tax_rate' => 0,
            'is_visible' => 1,
            'project_id' => $room->project_id,
            'excluding_tax_price' => 0,
            'pay_status' => 2,
            'payment_id' => 0,
            'room_id' => $request->room_id,
         ];

         $deposit_order_id = Order::insertGetId($deposit_order);

         $order = [];
         // 创建账单
         for ($i = 0; $i < $lease_term['number']; $i ++) {
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
             $order[$key]['due_date'] = $order_begin_date;
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

         // 更新房间状态变成已出租，并更新合同关联 ID 字段， 将预定 ID 设置为 0
         Room::find($request->room_id)->update([
             'status_mark' => 4, // 已出租
             'contract_id' => $contract_id,
             'reserve_id' => 0,
         ]);

         // 将预定状态改为已签约
         Reserve::find($request->reserve_id)->update([
            'reserve_status' => 3,
         ]);

         // 流水明细
         $payment = Payment::where('room_customer_id', $room_customer_id)->firstOrFail();
         $bill = [];
         $bill[0]['room_customer_id'] = $room_customer_id;
         $bill[0]['contract_id'] = $contract_id;
         $bill[0]['payment_id'] = $payment->id;
         $bill[0]['amount'] = -$reserve->reserve_amount;
         $bill[0]['begin_date'] = $begin_date;
         $bill[0]['end_date'] = $end_date;
         $bill[0]['room_id'] = $room->id;
         $bill[0]['project_id'] = $room->project_id;
         $bill[0]['accounting_subject_id'] = 3; // 定金
         $bill[0]['order_id'] = $deposit_order_id;
         $bill[0]['payment_type_id'] = $payment->payment_type_id;
         $bill[0]['created_at'] = Carbon::now();

         $bill[1]['room_customer_id'] = $room_customer_id;
         $bill[1]['contract_id'] = $contract_id;
         $bill[1]['payment_id'] = $payment->id;
         $bill[1]['amount'] = $reserve->reserve_amount;
         $bill[1]['begin_date'] = $begin_date;
         $bill[1]['end_date'] = $end_date;
         $bill[1]['room_id'] = $room->id;
         $bill[1]['project_id'] = $room->project_id;
         $bill[1]['accounting_subject_id'] = 1; // 押金
         $bill[1]['order_id'] = $deposit_order_id;
         $bill[1]['payment_type_id'] = $payment->payment_type_id;
         $bill[1]['created_at'] = Carbon::now();
         Bill::insert($bill);

         // 将定金抵扣到租金账单, 首先判断定金是否大于等于押金
         $pay_status = $reserve->reserve_amount > $request->rent ? 1 : 3;
         if ($pay_status == 1) {

            $unpaid_amount = 0;
         } else {

            $unpaid_amount = $request->rent - $reserve->reserve_amount;
         }
         Order::where('id', $deposit_order_id)->update([
            'paid_amount' => $reserve->reserve_amount,
            'unpaid_amount' => $unpaid_amount,
            'pay_status' => $pay_status,
         ]);

         return redirect()->route('fore.contracts.orders.show', $room_customer_id);
    }
}
