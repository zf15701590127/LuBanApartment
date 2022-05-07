@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">
        <div class="card-body">
          <h2 class="">
            @if ($price->id)
              编辑门店定价
            @else
              新建门店定价
            @endif
          </h2>

          <hr>

          @if ($price->id)
            <form action="{{ route('back.configs.prices.update', $price->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PATCH">
            @else
              <form action="{{ route('back.configs.prices.store') }}" method="POST" accept-charset="UTF-8">
          @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @include('shared._error')
            <div class="mb-3">
              <label for="project-id" class="form-label">项目名称</label>
              <select class="form-control bg-white" name="project_id" id="project-id" required>
                <option value="" hidden disabled {{ $price->id ? '' : 'selected' }}>请选择项目</option>
                @foreach ($projects as $value)
                  <option value="{{ $value->id }}" {{ $price->project_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="deposit" class="form-label">定金</label>
              <input name="deposit" type="number" step="0.01" class="form-control bg-white" id="deposit" placeholder="定金" value="{{ old('deposit', $price->deposit) }}" required>
            </div>
            <div class="mb-3">
              <label for="cold-water-fee" class="form-label">冷水费</label>
              <input name="cold_water_fee" type="number" step="0.01" class="form-control bg-white" id="cold-water-fee" placeholder="冷水费" value="{{ old('cold_water_fee', $price->cold_water_fee) }}" required>
            </div>
            <div class="mb-3">
              <label for="electricity-fee" class="form-label">电费</label>
              <input name="electricity_fee" type="number" step="0.01" class="form-control bg-white" id="electricity-fee" placeholder="电费" value="{{ old('electricity_fee', $price->electricity_fee) }}" required>
            </div>
            <div class="mb-3">
              <label for="change-room-fee" class="form-label">换房费</label>
              <input name="change_room_fee" type="number" step="0.01" class="form-control bg-white" id="change-room-fee" placeholder="换房费" value="{{ old('change_room_fee', $price->change_room_fee) }}" required>
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
