@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">

        <div class="card-body">
          <h2 class="">
            <i class="far fa-user"></i>
            @if ($user->id)
              编辑用户
            @else
              新建用户
            @endif
          </h2>

          <hr>

          @if ($user->id)
            <form action="{{ route('back.users.users.update', $user->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PATCH">
            @else
              <form action="{{ route('back.users.users.store') }}" method="POST" accept-charset="UTF-8">
          @endif

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          @include('shared._error')
            <div class="mb-3">
              <label for="name" class="form-label">用户名</label>
              <input name="name" type="text" class="form-control bg-white" id="name" placeholder="用户名" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">邮箱</label>
              <input name="email" type="email" class="form-control bg-white" id="email" placeholder="邮箱" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">密码</label>
              <input name="password" type="password" class="form-control bg-white" id="password">
            </div>
            <div class="mb-3">
              <label for="password-confirmation" class="form-label">重复密码</label>
              <input name="password_confirmation" type="password" class="form-control bg-white" id="password-confirmation">
            </div>
            <div class="well well-sm">
              <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
              <a class="btn btn-success" href="{{ route('back.users.users.index') }}"><i class="fa fa-reply mr-2" aria-hidden="true"></i> 返回</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
