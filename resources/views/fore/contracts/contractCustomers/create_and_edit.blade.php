@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">
        <div class="card-body">
          <h2 class="">
            @if ($contractCustomer->id)
              编辑入住人
            @else
              新建入住人
            @endif
          </h2>

          <hr>

          @if ($contractCustomer->id)
            <form action="{{ route('fore.contracts.contractCustomers.update', $contractCustomer->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PATCH">
            @else
              <form action="{{ route('fore.contracts.contractCustomers.store') }}" method="POST" accept-charset="UTF-8">
                <input type="hidden" name="room_customer_id" value="{{ $roomCustomerId }}">
          @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @include('shared._error')
            <div class="mb-3">
              <label for="name" class="form-label">入住人姓名</label>
              <input name="name" type="text" class="form-control bg-white" id="name" placeholder="入住人姓名" value="{{ old('name', $contractCustomer->name) }}" >
            </div>
            <div class="mb-3">
              <label for="certificate-type-id" class="form-label">证件类型</label>
              <select class="form-control bg-white" name="certificate_type_id" id="certificate-type-id">
                <option value="" hidden disabled {{ $contractCustomer->certificate_type_id ? '' : 'selected' }}>请选择证件类型</option>
                @foreach ($certificateTypes as $value)
                  <option value="{{ $value->id }}" {{ $contractCustomer->certificate_type_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="certificate-no" class="form-label">证件号</label>
              <input name="certificate_no" type="text" class="form-control bg-white" id="certificate-no" placeholder="证件号" value="{{ old('certificate_no', $contractCustomer->certificate_no) }}" >
            </div>
            <div class="mb-3">
              <label for="mobile-phone-number" class="form-label">手机号</label>
              <input name="mobile_phone_number" type="text" class="form-control bg-white" id="mobile-phone-number" placeholder="手机号" value="{{ old('mobile_phone_number', $contractCustomer->mobile_phone_number) }}" >
            </div>
            <div class="well well-sm">
              <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
              <a class="btn btn-success" href="{{ url()->previous() }}"><i class="fa fa-reply mr-2" aria-hidden="true"></i> 返回</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
