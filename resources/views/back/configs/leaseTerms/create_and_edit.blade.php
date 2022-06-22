@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">
        <div class="card-body">
          <h2 class="">
            @if ($leaseTerm->id)
              编辑租赁周期
            @else
              新建租赁周期
            @endif
          </h2>

          <hr>

          @if ($leaseTerm->id)
            <form action="{{ route('back.configs.leaseTerms.update', $leaseTerm->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PATCH">
            @else
              <form action="{{ route('back.configs.leaseTerms.store') }}" method="POST" accept-charset="UTF-8">
          @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @include('shared._error')
            <div class="mb-3">
              <label for="name" class="form-label">租赁周期名称</label>
              <input name="name" type="text" class="form-control bg-white" id="name" placeholder="租赁周期名称" value="{{ old('name', $leaseTerm->name) }}" required>
            </div>
            <div class="mb-3">
              <label for="number" class="form-label">租赁周期对应月数</label>
              <input name="number" type="number" class="form-control bg-white" id="number" placeholder="租赁周期对应月数" value="{{ old('name', $leaseTerm->number) }}" required>
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
