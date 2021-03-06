@extends('layouts.app')

@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
      <div class="card border-0">
        <img class="card-img-top"
          src="{{ $user->avatar }}" alt="{{ $user->name }}">
        <div class="card-body">
          <h5><strong>注册于</strong></h5>
          <p>{{ $user->created_at->diffForHumans() }}</p>
        </div>
      </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card border-0">
        <div class="card-body">
          <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
        </div>
      </div>
      <hr>

      {{-- 用户发布的内容 --}}
      <div class="card border-0">
        <div class="card-body">
          暂无数据 ~_~
        </div>
      </div>
    </div>
  </div>
@stop
