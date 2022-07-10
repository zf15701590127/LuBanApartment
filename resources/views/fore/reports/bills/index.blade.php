@extends('layouts.appfluid')

@section('content')

<div class="col-md-12">
  <div class="row px-3">
    <div class="col-10">
      <div class="px-3 py-3 bg-white rounded-3">
        @include('fore.reports._navbar')
        @if (count($bills))
        <div class="mt-3 mb-3 px-3 py-3 bg-light">数量：<span class="text-primary h5">{{ $quantity }}</span></div>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <tr>
                <th>项目名称</th>
                <th>房间号</th>
                <th>签约人姓名</th>
                <th>账单类型</th>
                <th>金额</th>
                <th>支付方式</th>
                <th>账单开始时间</th>
                <th>账单结束时间</th>
                <th>缴费时间</th>
              </tr>
              @foreach ($bills as $bill)
              <tr>
                <td>{{ $bill->project->name }}</td>
                <td>{{ $bill->room->name }}</td>
                <td>{{ $bill->roomCustomer->name }}</td>
                <td>{{ $bill->accountingSubject->name }}</td>
                <td>{{ $bill->amount }}</td>
                <td>{{ $bill->paymentType->name }}</td>
                <td>{{ date('Y-m-d', $bill->begin_date) }}</td>
                <td>{{ date('Y-m-d', $bill->end_date) }}</td>
                <td>{{ $bill->created_at }}</td>
              </tr>
              @endforeach
            </table>
          </div>
        <div class="mt-3">
          {{ $bills->appends($filters)->render() }}
        </div>
        @else
        <div class="empty-block">暂无数据 ~_~ </div>
        @endif
      </div>
    </div>
    <div class="col-2">
      <div class="card border-0">
        <div class="card-body pt-2">
          <div class="text-center mt-1 mb-0 text-muted">
            筛选
          </div>
          <hr class="mt-2 mb-3">
          <form action="{{ route('back.configs.projects.index') }}" method="GET" class="search-form">
            <div class="mb-3">
              <label for="search" class="form-label">项目名称</label>
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
