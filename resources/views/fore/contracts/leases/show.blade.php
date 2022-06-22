@extends('layouts.appFluid')

@section('content')

@include('fore.contracts._shared')
<div class="card border-0">
  <div class="card-body">
    @include('fore.contracts._navbar')
    <table class="table table-bordered text-center">
        <tr>
          <th>租约类型</th>
          <th>客户钱包</th>
          <th>冷水表读书</th>
          <th>电表读书</th>
          <th>支付状态</th>
        </tr>
        <tr>
          <td>{{ $roomCustomer->contractType->name }}</td>
          <td>{{ $roomCustomer->wallet }}</td>
          <td>{{ $roomCustomer->cold_water_read }}</td>
          <td>{{ $roomCustomer->electric_read }}</td>
          @switch($roomCustomer->pay_status)
            @case(1)
              <td>已支付</td>
              @break
            @case(2)
              <td>未支付</td>
              @break
            @case(3)
              <td>部分支付</td>
              @break
          @endswitch
        </tr>
    </table>
  </div>
</div>

@endsection
