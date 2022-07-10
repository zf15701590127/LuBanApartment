@extends('layouts.appFluid')

@section('content')
  <div class="row">
    <div class="col-10 mb-3">
      <div class="card bg-white p-3 border-0">
        <div class="card-header mb-3 bg-white h3">抱家公寓-火车站店</div>
        <div class="row row-cols-6 g-3">
          @foreach ($rooms as $room)
          <div class="col">
            @switch ($room->status_mark)
              @case(0)
                <div class="card text-dark bg-light h-100">{{-- 空置 --}}
                  <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $room->name }}</h5>
                    <div class="card-text">¥ {{ $room->store_price }}</div>
                    <div class="card-text">面积：{{ $room->area }}</div>
                    <div class="card-text">空置：{{ floor((time()-$room->move_out_date)/86400)}} 天</div>
                    <a href="{{ route('fore.contracts.contracts.create'). '?room_id=' . $room->id  }}" class="card-link link-dark">签约</a>
                    <a href="{{ route('fore.reserves.reserves.create'). '?room_id=' . $room->id  }}" class="card-link link-dark">预定</a>
                    <a href="javascript:void(0);" onclick="document.getElementById('dirtyStatusMark{{$room->id}}').submit();" class="card-link link-dark">脏房</a>
                    <a href="javascript:void(0);" onclick="document.getElementById('repairStatusMark{{$room->id}}').submit();" class="card-link link-dark">维修</a>
                    <form action="{{ route('fore.rooms.rooms.dirtyStatusMark', $room->id) }}" method="POST" id="dirtyStatusMark{{$room->id}}">@csrf</form>
                    <form action="{{ route('fore.rooms.rooms.repairStatusMark', $room->id) }}" method="POST" id="repairStatusMark{{$room->id}}">@csrf</form>
                  </div>
                </div>
              @break
              @case(1)
                <div class="card bg-danger text-white h-100">{{-- 维修 --}}
                  <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $room->name }}</h5>
                    <div class="card-text">¥ {{ $room->store_price }}</div>
                    <div class="card-text">面积：{{ $room->area }}</div>
                    <div class="card-text">空置：{{ floor((time()-$room->move_out_date)/86400)}} 天</div>
                    <a href="javascript:void(0);" onclick="document.getElementById('repairedStatusMark{{$room->id}}').submit();" class="card-link link-light">取消维修</a>
                    <form action="{{ route('fore.rooms.rooms.repairedStatusMark', $room->id) }}" method="POST" id="repairedStatusMark{{$room->id}}">@csrf</form>
                  </div>
                </div>
              @break
              @case(2)
                <div class="card bg-secondary text-white h-100">{{-- 脏房 --}}
                  <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $room->name }}</h5>
                    <div class="card-text">¥ {{ $room->store_price }}</div>
                    <div class="card-text">面积：{{ $room->area }}</div>
                    <div class="card-text">空置：{{ floor((time()-$room->move_out_date)/86400)}} 天</div>
                    <a href="javascript:void(0);" onclick="document.getElementById('cleanStatusMark{{$room->id}}').submit();" class="card-link link-light">取消脏房</a>
                    <form action="{{ route('fore.rooms.rooms.cleanStatusMark', $room->id) }}" method="POST" id="cleanStatusMark{{$room->id}}">@csrf</form>
                  </div>
                </div>
              @break
              @case(3)
              <div class="card bg-warning text-dark h-100">{{-- 已预定 --}}
                <div class="card-body">
                  <h5 class="card-title text-truncate">{{ $room->name }}</h5>
                  <div class="card-text">¥ {{ $room->store_price }}</div>
                  <div class="card-text">面积：{{ $room->area }}</div>
                  <div class="card-text">退：{{ date('Y-m-d', $room->reserve->end_date) }}</div>
                  <a href="{{ route('fore.contracts.orders.show', 2) }}" class="card-link link-dark">详情</a>
                </div>
              </div>
              @break
              @case(4)
                <div class="card bg-primary text-white h-100">{{-- 已出租 --}}
                  <div class="card-body">
                    <h5 class="card-title text-truncate">{{ $room->name }}</h5>
                    <div class="card-text">¥ {{ $room->contract->rent }}</div>
                    <div class="card-text">面积：{{ $room->area }}</div>
                    <div class="card-text">退：{{ date('Y-m-d', $room->contract->end_date) }} 天</div>
                    <a href="{{ route('fore.contracts.orders.show', $room->contract->room_customer_id) }}" class="card-link link-light">详情</a>
                    <a href="#" class="card-link link-light">备注</a>
                  </div>
                </div>
              @break
            @endswitch
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-2">
        <div class="card mb-3 border-0">
          <div class="card-header bg-white">
            房源状态
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    空房可租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    租赁中
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    空房可租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    租赁中
                  </label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    空房可租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                    租赁中
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3 border-0">
          <div class="card-header bg-white">
            业务状态
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠房租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠水电
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠房租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠水电
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠房租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠水电
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠房租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠水电
                  </label>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠房租
                  </label>
                </div>
              </div>
              <div class="col-6">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    欠水电
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mb-3 border-0">
          <div class="card-header bg-white">
            经营数据
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">房间总数：115</div>
              <div class="col-12">在租房间数：49</div>
              <div class="col-12">可租房间数：49</div>
              <div class="col-12">不可售房间数：49</div>
              <div class="col-12">本日出租率：90%</div>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection
