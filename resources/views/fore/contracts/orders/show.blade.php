@extends('layouts.appFluid')

@section('content')

@include('shared._error')
@include('fore.contracts._shared')
<div class="card border-0">
  <div class="card-body">
    @include('fore.contracts._navbar')
    <table class="table table-bordered text-center">
        <tr>
          <th>租约</th>
          <th>开始日期</th>
          <th>结束日期</th>
          <th>应收</th>
          <th>已收</th>
          <th>应支付日</th>
          <th>状态</th>
          <th>操作</th>
        </tr>
        @foreach ($orders as $order)
          <tr>
            @if ($order->accounting_subject_id == 1)
              <td>押金</td>
            @else
              <td>合同租金</td>
            @endif
            <td>{{ date('Y-m-d', $order->begin_date) }}</td>
            <td>{{ date('Y-m-d', $order->end_date) }}</td>
            <td>{{ $order->including_tax_price }}</td>
            <td>{{ $order->paid_amount }}</td>
            <td>{{ date('Y-m-d', $order->due_date) }}</td>
            @switch ($order->pay_status)
              @case(1)
                <td style="color:#e87749;">已支付</td>
                @break;
              @case(2)
                <td style="color:#e87749;">未支付</td>
                @break;
              @case(3)
                <td style="color:#e87749;">部分支付</td>
                @break;
            @endswitch
            <td><a href="javascript:void(0);" class="payment-link" data-bs-toggle="modal" data-bs-target="#payment" data-id="{{ $order->id }}" data-unpaid-amount="{{ $order->unpaid_amount }}">支付</a></td>
          </tr>
        @endforeach
    </table>
    <div class="mt-3">
      {{ $orders->render() }}
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
            <input type="number" name="amount" step="0.01" class="form-control bg-white" id="amount">
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
  $(document).ready(function() {
    $('.payment-link').click(function () {
      var id = $(this).data('id');
      var unpaid_amount = $(this).data('unpaid-amount');
      $('.payment-form').attr('action', '{{ url("fore/payments/") }}/'+id+'/order');
      $('.payment-form input[name=amount]').val(unpaid_amount);
    })
  })
</script>
@endsection
