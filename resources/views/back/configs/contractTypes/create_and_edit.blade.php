@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">
        <div class="card-body">
          <h2 class="">
            @if ($contractType->id)
              编辑合同类型
            @else
              新建合同类型
            @endif
          </h2>

          <hr>

          @if ($contractType->id)
            <form action="{{ route('back.configs.contractTypes.update', $contractType->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PATCH">
            @else
              <form action="{{ route('back.configs.contractTypes.store') }}" method="POST" accept-charset="UTF-8">
          @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @include('shared._error')
            <div class="mb-3">
              <label for="name" class="form-label">合同类型名称</label>
              <input name="name" type="text" class="form-control bg-white" id="name" placeholder="合同类型名称" value="{{ old('name', $contractType->name) }}" required>
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