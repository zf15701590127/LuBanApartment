@extends('layouts.appfluid')

@section('content')

<div class="col-md-12">
  <div class="row px-3">
    <div class="col-10">
      <div class="px-3 py-3 bg-white rounded-3">
        @include('fore.operations._navbar')
        @if (count($contracts))
        <div class="mt-3 mb-3 px-3 py-3 bg-light">数量：<span class="text-primary h5">{{ $quantity }}</span></div>
          <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
              <tr>
                <th>项目名称</th>
                <th>房间号</th>
                <th>租客姓名</th>
                <th>租客电话</th>
                <th>租金</th>
                <th>押金</th>
                <th>租期开始</th>
                <th>租期结束</th>
                <th>租期</th>
                <th>签约类型</th>
                <th>合同类型</th>
                <th>租赁类别</th>
                <th>操作</th>
              </tr>
              @foreach ($contracts as $contract)
              <tr>
                <td>{{ $contract->project->name }}</td>
                <td>{{ $contract->room->name }}</td>
                <td>{{ $contract->contractCustomer->name }}</td>
                <td>{{ $contract->contractCustomer->mobile_phone_number }}</td>
                <td>{{ $contract->rent }}</td>
                <td>{{ $contract->deposit_amount }}</td>
                <td>{{ date('Y-m-d', $contract->begin_date) }}</td>
                <td>{{ date('Y-m-d', $contract->end_date) }}</td>
                <td>{{ $contract->leaseTerm->name }}</td>
                <td>{{ $contract->signContractType->name }}</td>
                <td>{{ $contract->contractType->name }}</td>
                <td>{{ $contract->leaseType->name }}</td>
                <td><a href="{{ route('fore.contracts.contracts.show', $contract->room_customer_id) }}">明细</a></td>
              </tr>
              @endforeach
            </table>
          </div>
        <div class="mt-3">
          {{ $contracts->appends($filters)->render() }}
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
          <form action="{{ route('fore.reserves.reserves.index') }}" method="GET" class="search-form">
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
