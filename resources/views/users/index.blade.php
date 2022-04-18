@extends('layouts.appfluid')

@section('content')

<div class="col-md-12">
  <div class="row px-3">
    <div class="col-10">
      <div class="px-3 py-3 bg-white rounded-3">
        @include('shared._error')
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">用户列表</a>
          </li>
          </li>
        </ul>
        <div class="mt-3 mb-3 px-3 py-3 bg-light">合同总计：<span class="text-primary h5">123478</span></div>
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead>
              <tr>
                <th>用户名</th>
                <th>邮箱</th>
                <th>注册时间</th>
                <th>用户状态</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->deleted_at ? '禁用' : '启用' }}</td>
                <td>
                  <a class="btn btn-outline-primary btn-sm">修改</a>
                  @can('destroy', $user)
                    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger btn-sm" type="button">删除</button>
                    </form>
                  @endcan
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-3">
          {!! $users->render() !!}
        </div>
      </div>
    </div>
    <div class="col-2">
      <div class="card mb-3">
        <div class="card-body">
          <!-- Button trigger modal -->
          <a class="btn btn-primary w-100" href="{{ route('users.create') }}">
            新增用户
          </a>
        </div>
      </div>
      <div class="card">
        <div class="card-body pt-2">
          <div class="text-center mt-1 mb-0 text-muted">
            筛选
          </div>
          <hr class="mt-2 mb-3">
          <form action="" method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">用户名</label>
              <input type="text" class="form-control bg-white" id="name" placeholder="用户名">
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="button">提交</button>
              <button class="btn btn-primary" type="button">重置</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
