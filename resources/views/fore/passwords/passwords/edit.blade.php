@extends('layouts.app')

@section('content')

<div class="row">
  @include('fore.users.users._list')
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <nav class="navbar bg-white rounded-2 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">编辑资料</li>
          <li class="breadcrumb-item active" aria-current="page">修改密码</li>
        </ol>
      </nav>
    </nav>
    <hr>
    <div class="card-body bg-white rounded-2">
      <form action="{{ route('fore.passwords.passwords.update', Auth::id()) }}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('shared._error')

        <div class="mb-3">
          <label for="email-field" class="form-label">邮箱：</label>
          <input class="form-control" type="text" name="email" id="email-field" value="{{ $user->email }}" readonly/>
        </div>
        <div class="mb-3">
          <label for="password-field" class="form-label">密码</label>
          <input class="form-control bg-white" type="password" name="password" id="password-field" required/>
        </div>
        <div class="mb-3">
          <label for="password-confirmation-field" class="form-label">确认密码</label>
          <input class="form-control bg-white" type="password" name="password_confirmation" id="password-confirmation-field" required/>
        </div>
        <div class="well well-sm">
          <button type="submit" class="btn btn-primary text-white">保存</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
