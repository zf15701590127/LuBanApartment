@extends('layouts.appFluid')

@section('content')

<div class="col-md-12 bg-white p-3 rounded-3">
  <ul class="nav nav-tabs mb-3">
    <li class="nav-item">
      <a href="#" class="nav-link active bg-white">租约信息</a>
    </li>
  </ul>
  @include('shared._error')
  <form action="{{ route('fore.contracts.contracts.store') }}" method="POST">
    @csrf
    <div class="row px-3">
      <div class="col-4">
        <div class="mb-3">
          <label for="lease-type-id" class="form-label">租赁类别</label>
          <select name="lease_type_id" id="lease-type-id" class="form-select bg-white">
            @foreach ($leaseTypes as $leaseType)
              <option value="{{ $leaseType->id }}">{{ $leaseType->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="sign-contract-type-id" class="form-label">签约类型</label>
          <select name="sign_contract_type_id" id="sign-contract-type-id" class="form-select bg-white">
            @foreach ($signContractTypes as $signContractType)
              <option value="{{ $signContractType->id }}">{{ $signContractType->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="begin-date" class="form-label">租赁起始日期</label>
          <input name="begin_date" type="date" class="form-control bg-white" id="begin-date" value="{{ $today }}">
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="end-date" class="form-label">租赁结束日期</label>
          <input name="end_date" type="date" class="form-control bg-white" id="end-date">
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="lease-term-id" class="form-label">租期</label>
          <select name="lease_term_id" id="lease-term-id" class="form-select bg-white">
            @foreach ($leaseTerms as $leaseTerm)
              <option value="{{ $leaseTerm->id }}">{{ $leaseTerm->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="room-id" class="form-label">房间号</label>
          <select name="room_id" id="room-id" class="form-select bg-white">
            @foreach ($rooms as $room)
              <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="rent" class="form-label">租金</label>
          <input name="rent" type="number" class="form-control bg-white" id="rent" value="{{ $room->store_price }}">
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="period-type" class="form-label">周期方式</label>
          <select name="period_type" id="period-type" class="form-select bg-white">
            <option value="1">跨月</option>
            <option value="2">自然月</option>
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="deposit-month-id" class="form-label">押金</label>
          <select name="deposit_month_id" id="deposit-month-id" class="form-select bg-white">
            @foreach ($depositMonths as $depositMonth)
              <option value="{{ $depositMonth->id }}">{{ $depositMonth->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="user-id" class="form-label">所属销售</label>
          <select name="user_id" id="user-id" class="form-select bg-white">
            @foreach ($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="marketing-channel-id" class="form-label">销售渠道</label>
          <select name="marketing_channel_id" id="marketing-channel-id" class="form-select bg-white">
            @foreach ($marketingChannels as $marketingChannel)
              <option value="{{ $marketingChannel->id }}">{{ $marketingChannel->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <ul class="nav nav-tabs mb-3">
      <li class="nav-item">
        <a href="#" class="nav-link active bg-white">签约人信息</a>
      </li>
    </ul>
    <div class="row px-3">
      <div class="col-4">
        <div class="mb-3">
          <label for="customer-name" class="form-label">客户姓名</label>
          <input name="customer_name" id="customer-name" type="text" class="form-control bg-white">
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="mobile-phone-number" class="form-label">手机号</label>
          <input name="mobile_phone_number" id="mobile-phone-number" type="text" class="form-control bg-white">
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="certificate-type-id" class="form-label">证件类型</label>
          <select name="certificate_type_id" id="certificate-type-id" class="form-select bg-white">
            @foreach ($certificateTypes as $certificateType)
              <option value="{{ $certificateType->id }}">{{ $certificateType->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="mb-3">
          <label for="certificate-no" class="form-label">证件信息</label>
          <input name="certificate_no" id="certificate-no" type="text" class="form-control bg-white">
        </div>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">签约</button>
      </div>
    </div>
  </form>
</div>

@endsection
