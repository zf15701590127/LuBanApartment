@extends('layouts.appFluid')

@section('content')
  <div class="row">
    <div class="col-10 mb-3">
      <div class="card bg-white p-3 border-0">
        <div class="card-header mb-3">抱家公寓-火车站店</div>
        <div class="row row-cols-6 g-3">
          @foreach ($rooms as $value)
          <div class="col">
            <div class="card bg-primary text-white">
              <div class="card-body">
                <h5 class="card-title text-white text-truncate">{{ $value->name }}</h5>
                <h6 class="card-subtitle mb-2">¥ {{ $value->store_price }}</h6>
                <p class="card-text">面积：{{ $value->area }}</p>
                <p class="card-text">空置：{{ floor((time()-$value->move_out_date)/86400)}} 天</p>
              </div>
            </div>
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
