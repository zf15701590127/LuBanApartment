@extends('layouts.app')

@section('content')

<div class="row">
  @include('users._list')

  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <nav class="navbar bg-white rounded-2 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
          <li class="breadcrumb-item">编辑资料</li>
          <li class="breadcrumb-item active" aria-current="page">个人信息</li>
        </ol>
      </nav>
    </nav>
    <hr>
    <div class="card-body bg-white rounded-2">
      <form action="{{ route('users.foreUsersUpdate', $user->id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('shared._error')

        <div class="mb-3">
          <label for="name-field" class="form-label">用户名</label>
          <input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $user->name) }}" readonly/>
        </div>
        <div class="mb-3">
          <label for="email-field" class="form-label">邮 箱</label>
          <input class="form-control bg-white" type="text" name="email" id="email-field" value="{{ old('email', $user->email) }}" required/>
        </div>
        <div class="mb-4">
          <label for="" class="avatar-label form-label">用户头像</label>
          <input type="file" name="avatar" class="form-control bg-white">
          @if($user->avatar)
            <br>
            <img class="thumbnail img-responsive" src="{{ $user->avatar }}" width="200" />
          @endif
        </div>
        <div class="well well-sm">
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
