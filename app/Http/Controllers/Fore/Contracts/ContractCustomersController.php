<?php

namespace App\Http\Controllers\Fore\Contracts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContractCustomer;
use App\Models\CertificateType;
use App\Models\RoomCustomer;
use App\Http\Requests\Fore\ContractCustomerRequest;

class ContractCustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($room_customer_id)
    {
        $contractCustomers = ContractCustomer::where('room_customer_id', $room_customer_id)->get();

        $roomCustomer = RoomCustomer::where('id', $room_customer_id)->firstOrFail();

        return view('fore.contracts.contractCustomers.show', [
            'contractCustomers' => $contractCustomers,
            'roomCustomer' => $roomCustomer,
        ]);
    }

    public function create(Request $request, ContractCustomer $contractCustomer)
    {
        // 获取证件信息
        $certificateTypes = CertificateType::all();

        return view('fore.contracts.contractCustomers.create_and_edit', [
            'roomCustomerId' => $request->room_customer_id,
            'contractCustomer' => $contractCustomer,
            'certificateTypes' => $certificateTypes,
        ]);
    }

    public function store(ContractCustomerRequest $request)
    {
        $room_customer = RoomCustomer::where('id', $request->room_customer_id)->firstOrFail();

        $contractCustomer = [];
        $contractCustomer['name'] = $request->name;
        $contractCustomer['room_customer_id'] = $request->room_customer_id;
        $contractCustomer['is_contractor'] = 2;
        $contractCustomer['certificate_type_id'] = $request->certificate_type_id;
        $contractCustomer['certificate_no'] = $request->certificate_no;
        $contractCustomer['sex'] = (substr($request->certificate_no, (strlen($request->certificate_no) == 15 ? -1 : -2), 1) % 2) == 0 ? 2 : 1;
        $contractCustomer['mobile_phone_number'] = $request->mobile_phone_number;
        $contractCustomer['project_id'] = $room_customer->project_id;
        $contractCustomer['room_id'] = $room_customer->room_id;

        ContractCustomer::insert($contractCustomer);

        return redirect()->route('fore.contracts.contractCustomers.show', $request->room_customer_id);

    }

    public function edit(ContractCustomer $contractCustomer)
    {
        // 获取证件信息
        $certificateTypes = CertificateType::all();

        return view('fore.contracts.contractCustomers.create_and_edit', [
            'contractCustomer' => $contractCustomer,
            'certificateTypes' => $certificateTypes,
        ]);
    }

    public function update(ContractCustomer $contractCustomer, ContractCustomerRequest $request)
    {
        $contractCustomer->update($request->all());

        return redirect()->route('fore.contracts.contractCustomers.show', $contractCustomer->room_customer_id)->with('success', '更新成功！');
    }

    public function destroy(ContractCustomer $contractCustomer)
    {
        $contractCustomer->delete();

        return redirect()->route('fore.contracts.contractCustomers.show', $contractCustomer->room_customer_id)->with('success', '成功删除！');
    }
}
