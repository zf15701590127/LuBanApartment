@extends('layouts.appfluid')

@section('content')

<div class="col-md-12">
  <div class="row px-3">
    @include('back.configs._list')
    <div class="col-8">
      <div class="px-3 py-3 bg-white rounded-3">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">支付方式配置</a>
          </li>
          </li>
        </ul>
        @if (count($paymentTypes))
        <div class="mt-3 mb-3 px-3 py-3 bg-light">项目数量：<span class="text-primary h5">{{ $quantity }}</span></div>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <tr>
                <th>支付方式名称</th>
                <th>操作</th>
              </tr>
              @foreach ($paymentTypes as $paymentType)
              <tr>
                <td>{{ $paymentType->name }}</td>
                <td>
                  <a class="btn btn-outline-primary btn-sm" href="{{ route('back.configs.paymentTypes.edit', $paymentType->id) }}">修改</a>
                    <form action="{{ route('back.configs.paymentTypes.destroy', $paymentType->id) }}" method="post" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-outline-danger btn-sm" type="button">删除</button>
                    </form>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        <div class="mt-3">
          {{ $paymentTypes->appends($filters)->render() }}
        </div>
        @else
        <div class="empty-block">暂无数据 ~_~ </div>
        @endif
      </div>
    </div>
    <div class="col-2">
      <div class="card mb-3 border-0">
        <div class="card-body">
          <!-- Button trigger modal -->
          <a class="btn btn-primary w-100" href="{{ route('back.configs.paymentTypes.create') }}">
            新增支付方式
          </a>
        </div>
      </div>
      <div class="card border-0">
        <div class="card-body pt-2">
          <div class="text-center mt-1 mb-0 text-muted">
            筛选
          </div>
          <hr class="mt-2 mb-3">
          <form action="{{ route('back.configs.paymentTypes.index') }}" method="GET" class="search-form">
            <div class="mb-3">
              <label for="search" class="form-label">支付方式名称</label>
              <input name="search" type="text" class="form-control bg-white" id="search" placeholder="项目名称">
            </div>
            <div class="d-grid gap-2">
              <button class="btn btn-primary" type="submit">提交</button>
              <button class="btn btn-primary" type="reset">重置</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    var filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
      $('.search-form input[name=search]').val(filters.search);
    })
  </script>
@endsection
