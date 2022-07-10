@extends('layouts.appFluid')

@section('content')

@include('fore.contracts._shared')
<div class="card border-0">
  <div class="card-body">
    @include('fore.contracts._navbar')
    <table class="table table-bordered text-center">
        <tr>
          <th>客户钱包</th>
          <th>冷水表读书</th>
          <th>电表读书</th>
        </tr>
        <tr>
          <td>{{ $roomCustomer->wallet }}</td>
          <td>{{ $roomCustomer->cold_water_read }}</td>
          <td>{{ $roomCustomer->electric_read }}</td>
        </tr>
    </table>
  </div>
</div>

@endsection
