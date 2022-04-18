@extends('layouts.app')

@section('content')

<div class="row mb-5">
  <div class="col-lg-9 col-md-9 topic-list">
    <div class="card ">

      <div class="card-header bg-transparent">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link {{ active_class(if_route('topics.index')) }}" href="{{ route('topics.index') }}">全部</a></li>
          <li class="nav-item"><a class="nav-link {{ active_class((if_route('topicCategories.show') && if_route_param('topicCategory', 1))) }}" href="{{ route('topicCategories.show', 1) }}">分享</a></li>
          <li class="nav-item"><a class="nav-link {{ active_class((if_route('topicCategories.show') && if_route_param('topicCategory', 2))) }}" href="{{ route('topicCategories.show', 2) }}">教程</a></li>
          <li class="nav-item"><a class="nav-link {{ active_class((if_route('topicCategories.show') && if_route_param('topicCategory', 3))) }}" href="{{ route('topicCategories.show', 3) }}">问答</a></li>
          <li class="nav-item"><a class="nav-link {{ active_class((if_route('topicCategories.show') && if_route_param('topicCategory', 4))) }}" href="{{ route('topicCategories.show', 4) }}">公告</a></li>
        </ul>
      </div>

      <div class="card-body">
        {{-- 话题列表 --}}
        @include('topics._topic_list', ['topics' => $topics])
        {{-- 分页 --}}
        <div class="mt-5">
          {!! $topics->appends(Request::except('page'))->render() !!}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-3 sidebar">
    @include('topics._sidebar')
  </div>
</div>

@endsection
