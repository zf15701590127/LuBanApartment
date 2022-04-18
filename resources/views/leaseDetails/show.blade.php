@extends('layouts.app')

@section('title', '租约详情')

@section('content')

<div class="card text-center">
  @include('shared._details_card_header')
  <div class="card-body">
    <div class="card mb-3">
      <div class="card-header text-start">基本信息</div>
      <div class="card-body">
        <div class="row">
          <div class="col line-height">
            <div class="row">
              <div class="col text-end border border-secondary">房间号</div>
              <div class="col text-start border border-secondary">102</div>
            </div>
          </div>
          <div class="col line-height">
            <div class="row">
              <div class="col text-end  border border-secondary">合同时间</div>
              <div class="col text-start  border border-secondary">2022-01-01 至 2021-02-26</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">入住类别</div>
              <div class="col-6 text-start  border border-secondary">直接签约</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">所属渠道</div>
              <div class="col-6 text-start  border border-secondary">58品牌公寓</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">入住时间</div>
              <div class="col-6 text-start  border border-secondary">2021-09-15 16:35:39</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">账户余额</div>
              <div class="col-6 text-start  border border-secondary">100.00</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end border border-secondary">所属销售</div>
              <div class="col-6 text-start border border-secondary">邹志文</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end border border-secondary">所属销售</div>
              <div class="col-6 text-start border border-secondary">邹志文</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3"">
      <div class="card-header text-start">签约费用信息</div>
      <div class="card-body">
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end border border-secondary">签约总金额</div>
              <div class="col-6 text-start border border-secondary">39600.00 元</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">交租类型</div>
              <div class="col-6 text-start  border border-secondary">按跨月支付</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">租金</div>
              <div class="col-6 text-start  border border-secondary">3300元（支付周期：1个月一付）</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">押金</div>
              <div class="col-6 text-start  border border-secondary">3300.00 元</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">冷水信息</div>
              <div class="col-6 text-start  border border-secondary">当前抄表：102吨，单价：6.5元/吨</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">电费信息</div>
              <div class="col-6 text-start  border border-secondary">当前抄表：4419.19度，单价：1.5元/度</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
