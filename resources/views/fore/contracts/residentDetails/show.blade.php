@extends('layouts.app')

@section('content')

<div class="card text-center">
  @include('shared._details_card_header')
  <div class="card-body">
    <div class="card mb-3">
      <div class="card-header text-start">主签人信息</div>
      <div class="card-body">
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end border border-secondary">姓名</div>
              <div class="col-6 text-start border border-secondary">赵福</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">房间号</div>
              <div class="col-6 text-start  border border-secondary">117</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">性别</div>
              <div class="col-6 text-start  border border-secondary">先生</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">手机号</div>
              <div class="col-6 text-start  border border-secondary">15701590127</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">入住状态</div>
              <div class="col-6 text-start  border border-secondary">搬离</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">身份证号码</div>
              <div class="col-6 text-start  border border-secondary">232700199305060615</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mb-3">
      <div class="card-header text-start">同住人信息</div>
      <div class="card-body">
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end border border-secondary">姓名</div>
              <div class="col-6 text-start border border-secondary">赵福</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">房间号</div>
              <div class="col-6 text-start  border border-secondary">117</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">性别</div>
              <div class="col-6 text-start  border border-secondary">先生</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">手机号</div>
              <div class="col-6 text-start  border border-secondary">15701590127</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">入住状态</div>
              <div class="col-6 text-start  border border-secondary">搬离</div>
            </div>
          </div>
          <div class="col-6 line-height">
            <div class="row">
              <div class="col-6 text-end  border border-secondary">身份证号码</div>
              <div class="col-6 text-start  border border-secondary">232700199305060615</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
