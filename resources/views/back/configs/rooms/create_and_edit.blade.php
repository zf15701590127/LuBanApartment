@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">
        <div class="card-body">
          <h2 class="">
            @if ($room->id)
              编辑房间
            @else
              新建房间
            @endif
          </h2>

          <hr>

          @if ($room->id)
            <form action="{{ route('back.configs.rooms.update', $room->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PATCH">
            @else
              <form action="{{ route('back.configs.rooms.store') }}" method="POST" accept-charset="UTF-8">
          @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @include('shared._error')
            <div class="mb-3">
              <label for="project-id" class="form-label">项目名称</label>
              <select class="form-control bg-white" name="project_id" id="project-id" required>
                <option value="" hidden disabled {{ $room->id ? '' : 'selected' }}>请选择项目</option>
                @foreach ($projects as $value)
                  <option value="{{ $value->id }}" {{ $room->project_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="building-id" class="form-label">楼栋名称</label>
              <select class="form-control bg-white" name="building_id" id="building-id" required>
                <option value="" hidden disabled {{ $room->id ? '' : 'selected' }}>请选择楼栋</option>
                @foreach ($buildings as $value)
                  <option value="{{ $value->id }}" {{ $room->building_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">房间名称</label>
              <input name="name" type="text" class="form-control bg-white" id="name" placeholder="房间名称" value="{{ old('name', $room->name) }}" required>
            </div>
            <div class="mb-3">
              <label for="floor" class="form-label">楼层</label>
              <input name="floor" type="number" class="form-control bg-white" id="floor" placeholder="楼层" value="{{ old('floor', $room->floor) }}" required>
            </div>
            <div class="mb-3">
              <label for="purpose-id" class="form-label">用途名称</label>
              <select class="form-control bg-white" name="purpose_id" id="purpose-id" required>
                <option value="" hidden disabled {{ $room->id ? '' : 'selected' }}>请选择房间用途</option>
                @foreach ($purposes as $value)
                  <option value="{{ $value->id }}" {{ $room->purpose_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="benchmark-price" class="form-label">基础价格</label>
              <input name="benchmark_price" type="number" step="0.01" class="form-control bg-white" id="benchmark-price" placeholder="基础价格" value="{{ old('benchmark_price', $room->benchmark_price) }}" required>
            </div>
            <div class="mb-3">
              <label for="store-price" class="form-label">门店价格</label>
              <input name="store_price" type="number" step="0.01" class="form-control bg-white" id="store-price" placeholder="门店价格" value="{{ old('store_price', $room->store_price) }}" required>
            </div>
            <div class="mb-3">
              <label for="order" class="form-label">排序</label>
              <input name="order" type="number" class="form-control bg-white" id="order" placeholder="排序" value="{{ old('order', $room->order) }}" required>
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
