@extends('layouts.appFluid')

@section('content')

@include('fore.contracts._shared')
<div class="card border-0">
  <div class="card-body">
    @include('fore.contracts._navbar')
    <table class="table table-bordered text-center">
        <tr>
          <th>创建时间</th>
          <th>租赁类型</th>
          <th>签约类型</th>
          <th>合同类型</th>
          <th>房间号</th>
          <th>租金</th>
          <th>押金</th>
          <th>租赁人</th>
          <th>联系电话</th>
          <th>开始日期</th>
          <th>结束日期</th>
          <th>所属销售</th>
        </tr>
        @foreach ($contracts as $contract)
          <tr>
            <td>{{ $contract->created_at }}</td>
            <td>{{ $contract->leaseType->name }}</td>
            <td>{{ $contract->signContractType->name }}</td>
            <td>{{ $contract->contractType->name }}</td>
            <td>{{ $contract->room->name }}</td>
            <td>{{ $contract->rent }}</td>
            <td>{{ $contract->deposit_amount }}</td>
            <td>{{ $contract->contractCustomer->name }}</td>
            <td>{{ $contract->contractCustomer->mobile_phone_number }}</td>
            <td>{{ date('Y-m-d', $contract->begin_date) }}</td>
            <td>{{ date('Y-m-d', $contract->end_date) }}</td>
            <td>{{ $contract->user->name }}</td>
          </tr>
        @endforeach
    </table>
  </div>
</div>

@endsection
