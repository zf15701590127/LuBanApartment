@extends('layouts.app')

@section('content')

<div class="card text-center">
  @include('shared._details_card_header')
  <div class="card-body">
    <div class="card mb-3">
      <div class="card-header text-start">账单明细</div>
      <div class="card-body">
        <ul class="list-unstyled">
          <li>
            <div class="row" style="line-height: 21px">
              <div class="col">租约</div>
              <div class="col">账单周期</div>
              <div class="col">应付</div>
              <div class="col">已付</div>
              <div class="col">应支付日</div>
              <div class="col">状态</div>
            </div>
          </li>
          <li>
            <div class="row align-items-center" style="line-height: 21px">
              <div class="col">押金</div>
              <div class="col"><sapn>2021-02-01 <br> 2027-01-31</span></div>
              <div class="col">1000</div>
              <div class="col">1000</div>
              <div class="col">2021-02-01</div>
              <div class="col">已完成</div>
            </div>
          </li><li>
            <div class="row align-items-center" style="line-height: 21px">
              <div class="col">1期</div>
              <div class="col"><sapn>2021-02-01 <br> 2027-01-31</span></div>
              <div class="col">4500</div>
              <div class="col">0</div>
              <div class="col">2021-02-01</div>
              <div class="col">待付</div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection
