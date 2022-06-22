@extends('layouts.appfluid')

@section('content')

<div class="col-md-12">
  <div class="row px-3">
    @include('back.configs._list')
    <div class="col-8">
      <div class="px-3 py-3 bg-white rounded-3">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">门店定价配置</a>
          </li>
          </li>
        </ul>
        @if (count($prices))
        <div class="mt-3 mb-3 px-3 py-3 bg-light">门店定价数量：<span class="text-primary h5">{{ $quantity }}</span></div>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <tr>
                <th>所属项目</th>
                <th>定金</th>
                <th>冷水费</th>
                <th>电费</th>
                <th>换房费</th>
                <th>操作</th>
              </tr>
              @foreach ($prices as $price)
              <tr>
                <td>{{ $price->project->name }}</td>
                <td>{{ $price->deposit }}</td>
                <td>{{ $price->cold_water_fee }}</td>
                <td>{{ $price->electricity_fee }}</td>
                <td>{{ $price->change_room_fee }}</td>
                <td>
                  <a class="btn btn-outline-primary btn-sm" href="{{ route('back.configs.prices.edit', $price->id) }}">修改</a>
                    <form action="{{ route('back.configs.prices.destroy', $price->id) }}" method="post" class="d-inline">
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
          {{ $prices->appends($filters)->render() }}
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
          <a class="btn btn-primary w-100" href="{{ route('back.configs.prices.create') }}">
            新增门店定价
          </a>
        </div>
      </div>
      <div class="card border-0">
        <div class="card-body pt-2">
          <div class="text-center mt-1 mb-0 text-muted">
            筛选
          </div>
          <hr class="mt-2 mb-3">
          <form action="{{ route('back.configs.prices.index') }}" method="GET" class="search-form">
            <div class="mb-3">
              <label for="project-id" class="form-label">项目筛选</label>
              <select name="project_id" id="project-id" class="form-select bg-white">
                <option value="">全部</option>
                @foreach ($projects as $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
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
      $('.search-form select[name=project_id]').val(filters.project_id);

      // 自动提交
      $('.search-form select[name=project_id]').on('change', function() {
        $('.search-form').submit();
      });
    })
  </script>
@endsection
