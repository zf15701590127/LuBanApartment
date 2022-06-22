@extends('layouts.appFluid')

@section('content')

@include('fore.contracts._shared')
<div class="card border-0">
  <div class="card-body">
    @include('fore.contracts._navbar')
    <a href="{{ route('fore.contracts.contractCustomers.create'). '?room_customer_id=' . $roomCustomer->id }}" class="btn btn-primary btn-sm mb-3">新增入住人</a>
    <table class="table table-bordered text-center align-middle">
        <tr>
          <th>租客类别</th>
          <th>姓名</th>
          <th>性别</th>
          <th>手机号</th>
          <th>证件类型</th>
          <th>证件号</th>
          <th>操作</th>
        </tr>
        @foreach ($contractCustomers as $contractCustomer)
          <tr>
            @if ($contractCustomer->is_contractor == 1)
                <td>签约人</td>
              @else
                <td>同住人</td>
            @endif
            <td>{{ $contractCustomer->name }}
              @if ($contractCustomer->sex == 1)
                <td>男</td>
              @else
                <td>女</td>
              @endif
            </td>
            <td>{{ $contractCustomer->mobile_phone_number }}</td>
            <td>{{ $contractCustomer->certificateType->name }}</td>
            <td>{{ $contractCustomer->certificate_no }}</td>
            <td>
                <a class="btn btn-warning btn-sm" href="{{ route('fore.contracts.contractCustomers.edit', $contractCustomer->id) }}">修改</a>
                <form action="{{ route('fore.contracts.contractCustomers.destroy', $contractCustomer->id) }}" method="post"
                      style="display: inline-block;"
                      onsubmit="return confirm('您确定已经搬离了吗？');">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-danger btn-sm">搬离</button>
                </form>
            </td>
          </tr>
        @endforeach
    </table>
  </div>
</div>

@endsection
