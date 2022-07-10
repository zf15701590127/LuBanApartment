@extends('layouts.appFluid')

@section('content')

<div class="col-md-12 bg-white p-3 rounded-3">
  <ul class="nav nav-tabs mb-3">
    <li class="nav-item">
      <a href="#" class="nav-link active bg-white">预定信息</a>
    </li>
  </ul>
  @include('shared._error')
  <form action="{{ route('fore.reserves.reserves.store') }}" method="POST">
    @csrf
    <div class="row px-3">
      <div class="col-4">
        <div class="mb-3">
          <label for="lease-type-id" class="form-label">租赁类别</label>
          <select name="lease_type_id" id="lease-type-id" class="form-select bg-white" required>
            @foreach ($leaseTypes as $leaseType)
              <option value="{{ $leaseType->id }}">{{ $leaseType->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="begin-date" class="form-label">租赁起始日期</label>
          <input name="begin_date" type="date" class="form-control bg-white" id="begin-date" value="{{ $today }}" required>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="end-date" class="form-label">租赁结束日期</label>
          <input name="end_date" type="date" class="form-control bg-white" id="end-date" required>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="lease-term-id" class="form-label">租期</label>
          <select name="lease_term_id" id="lease-term-id" class="form-select bg-white" required>
            @foreach ($leaseTerms as $leaseTerm)
              <option value="{{ $leaseTerm->id }}">{{ $leaseTerm->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="room-id" class="form-label">房间号</label>
          <select name="room_id" id="room-id" class="form-select bg-white" required>
            @foreach ($rooms as $room)
              <option value="{{ $room->id }}" {{ $room->id == $room_id ? 'selected' : '' }}>{{ $room->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="rent" class="form-label">租金</label>
          <input name="rent" type="number" step="0.01" class="form-control bg-white" id="rent" value="{{ $room->store_price }}" required>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="deposit-month-id" class="form-label">押金</label>
          <select name="deposit_month_id" id="deposit-month-id" class="form-select bg-white" required>
            @foreach ($depositMonths as $depositMonth)
              <option value="{{ $depositMonth->id }}">{{ $depositMonth->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="name" class="form-label">预定人</label>
          <input name="name" type="text" id="name" class="form-control bg-white" required>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="mobile-phone-number" class="form-label">手机号</label>
          <input name="mobile_phone_number" type="number" class="form-control bg-white" id="mobile-phone-number" required>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="reserve-amount" class="form-label">预定金额</label>
          <input name="reserve_amount" type="number" step="0.01" class="form-control bg-white" id="reserve-amount" required>
        </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">预定</button>
      </div>
    </div>
  </form>
</div>

@endsection
