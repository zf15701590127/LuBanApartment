<?php

namespace App\Http\Controllers\Fore\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\Reserve;
use App\Http\Requests\Fore\PaymentRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function order(Order $order, PaymentRequest $request)
    {
        // 判断支付的金额必须小于待支付金额
        $amount = $request->amount;
        if ($order->unpaid_amount < $amount) {
            return redirect()->route('fore.contracts.orders.show', $order->room_customer_id)->with('danger', '支付金额必须小于待支付金额。');
        }

        // 更新账单状态
        $order['paid_amount'] = $order['paid_amount'] + $amount;
        $order['unpaid_amount'] = bcsub($order->including_tax_price, $order['paid_amount'], 2);
        // 判断是否还有未支付金额
        if ($order['unpaid_amount'] == 0) {
            // 已支付
            $order['pay_status'] = 1;
        } else {
            // 部分支付
            $order['pay_status'] = 3;
        }
        $order->save();

         // 账单已支付更新合同的最近缴费日期 recent_due_date, recent_due_date = 1 表示合同账单已全部缴纳
         $recent_dus_date = Order::where('contract_id', $order->contract_id)->where('pay_status', '<>', 1)->pluck('due_date')->min() ? : 1;
         Contract::where('id', $order->contract_id)->update(['recent_due_date' => $recent_dus_date]);

        // 生成交易流水
        $payment = [];

        $payment['order_no'] = $this->generateNo();
        $payment['room_customer_id'] = $order->room_customer_id;
        $payment['contract_id'] = $order->contract_id;
        $payment['amount'] = $amount;
        $payment['room_id'] = $order->room_id;
        $payment['project_id'] = $order->project_id;
        $payment['payment_no'] = '';
        $payment['payment_type_id'] = $request->paymentTypeId;
        $payment['created_at'] = Carbon::now();
        $payment_id = Payment::insertGetId($payment);

        // 生成流水明细
        $bill = [];
        $bill['room_customer_id'] = $order->room_customer_id;
        $bill['contract_id'] = $order->contract_id;
        $bill['payment_id'] = $payment_id;
        $bill['amount'] = $amount;
        $bill['begin_date'] = $order->begin_date;
        $bill['end_date'] = $order->end_date;
        $bill['room_id'] = $order->room_id;
        $bill['project_id'] = $order->project_id;
        $bill['accounting_subject_id'] = $order->accounting_subject_id;
        $bill['order_id'] = $order->id;
        $bill['payment_type_id'] = $request->paymentTypeId;
        $bill['created_at'] = Carbon::now();
        Bill::insert($bill);

        return redirect()->route('fore.contracts.orders.show', $order->room_customer_id);

    }

    public function reserve(Reserve $reserve, PaymentRequest $request)
    {
        if ($reserve->reserve_status == 1 && $reserve->reserve_amount == $request->amount){

            $reserve->reserve_status = 2;
            $reserve->save();

            // 生成交易流水
            $payment = [];

            $payment['order_no'] = $this->generateNo();
            $payment['room_customer_id'] = $reserve->room_customer_id;
            $payment['contract_id'] = 0;
            $payment['amount'] = $reserve->reserve_amount;
            $payment['room_id'] = $reserve->room_id;
            $payment['project_id'] = $reserve->project_id;
            $payment['payment_no'] = '';
            $payment['payment_type_id'] = $request->paymentTypeId;
            $payment['created_at'] = Carbon::now();
            $payment_id = Payment::insertGetId($payment);

            // 生成流水明细
            $bill = [];
            $bill['room_customer_id'] = $reserve->room_customer_id;
            $bill['contract_id'] = 0;
            $bill['payment_id'] = $payment_id;
            $bill['amount'] = $reserve->reserve_amount;
            $bill['begin_date'] = $reserve->begin_date;
            $bill['end_date'] = $reserve->end_date;
            $bill['room_id'] = $reserve->room_id;
            $bill['project_id'] = $reserve->project_id;
            $bill['accounting_subject_id'] = 3; // 定金
            $bill['order_id'] = 0;
            $bill['payment_type_id'] = $request->paymentTypeId;
            $bill['created_at'] = Carbon::now();
            Bill::insert($bill);

            return back()->with('success', '支付成功！');

        } else {
            return back()->with('danger', '参数错误请联系管理员。');
        }
    }

    // 生成交易单号
    public function generateNo()
    {
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        }

        return $no;
    }
}
