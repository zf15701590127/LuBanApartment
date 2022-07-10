@extends('layouts.appfluid')

@section('content')

@include('shared._error')
<div class="col-md-12">
  <div class="row px-3">
    <div class="col-10">
      <div class="px-3 py-3 bg-white rounded-3">
        @include('fore.operations._navbar')
        @if (count($reserves))
        <div class="mt-3 mb-3 px-3 py-3 bg-light">数量：<span class="text-primary h5">{{ $quantity }}</span></div>
          <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
              <tr>
                <th>项目名称</th>
                <th>房间号</th>
                <th>预定人姓名</th>
                <th>预定人电话</th>
                <th>预定金额</th>
                <th>约定租期开始</th>
                <th>约定租期结束</th>
                <th>约定租期</th>
                <th>约定租金</th>
                <th>租赁类别</th>
                <th>操作</th>
              </tr>
              @foreach ($reserves as $reserve)
              <tr>
                <td>{{ $reserve->project->name }}</td>
                <td>{{ $reserve->room->name }}</td>
                <td>{{ $reserve->name }}</td>
                <td>{{ $reserve->mobile_phone_number }}</td>
                <td>{{ $reserve->reserve_amount }}</td>
                <td>{{ date('Y-m-d', $reserve->begin_date) }}</td>
                <td>{{ date('Y-m-d', $reserve->end_date) }}</td>
                <td>{{ $reserve->lease_term_id }}</td>
                <td>{{ $reserve->rent }}</td>
                <td>{{ $reserve->lease_type->name }}</td>
                @switch($reserve->reserve_status)
                    @case(1)
                      <td>
                        <a href="javascript:void(0);" class="payment-link" data-bs-toggle="modal" data-bs-target="#payment" data-id="{{ $reserve->id }}" data-reserve-amount="{{ $reserve->reserve_amount }}">支付</a>
                        <a href="javascript:void(0);" onclick="document.getElementById('cancel{{$reserve->id}}').submit();">取消</a>
                        <form action="{{ route('fore.reserves.reserves.cancel', $reserve->id) }}" method="POST" id="cancel{{$reserve->id}}">@csrf</form>
                      </td>
                      @break
                    @case(2)
                      <td>
                        <a href="{{ route('fore.contracts.contracts.create'). '?reserve_id=' . $reserve->id }}">签约</a>
                        <a href="">退定</a>
                      </td>
                      @break
                    @case(3)
                      <td>已签约</td>
                      @break
                    @case(4)
                      <td>已取消</td>
                      @break
                    @default
                @endswitch

              </tr>
              @endforeach
            </table>
          </div>
        <div class="mt-3">
          {{ $reserves->appends($filters)->render() }}
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

<!-- Modal -->
<div class="modal fade" id="payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="payment">支付</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="POST" class="payment-form">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="amount" class="form-label">支付金额</label>
            <input type="number" name="amount" step="0.01" class="form-control bg-white" id="amount" readonly>
          </div>
          <label class="form-label me-3">支付方式</label>
          @foreach ($paymentTypes as $value)
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="paymentTypeId" type="radio" id="paymentType{{ $value->id }}" value="{{ $value->id }}">
            <label class="form-check-label" for="paymentType{{ $value->id }}">{{ $value->name }}</label>
          </div>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
          <button type="submit" class="btn btn-primary">提交</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script>
    var filters = {!! json_encode($filters) !!};
    $(document).ready(function () {
      // 搜索
      $('.search-form input[name=search]').val(filters.search);

      // 支付
      $('.payment-link').click(function () {
        var id = $(this).data('id');
        var reserve_amount = $(this).data('reserve-amount');
        $('.payment-form').attr('action', '{{ url("fore/payments/") }}/'+id+'/reserve');
        $('.payment-form input[name=amount]').val(reserve_amount);
      })
    })
  </script>
@endsection
