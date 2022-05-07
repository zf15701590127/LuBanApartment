<div class="col-2">
  <ul class="list-group list-group-flush rounded-3">
    <a href="{{ route('back.configs.projects.index') }}" class="list-group-item list-group-item-action {{ active_class(if_route('back.configs.projects.index')) }}">项目配置</a>
    <a href="{{ route('back.configs.topicCategories.index')}}" class="list-group-item list-group-item-action {{ active_class(if_route('back.configs.topicCategories.index')) }}">话题分类配置</a>
    <a href="{{ route('back.configs.buildings.index')}}" class="list-group-item list-group-item-action {{ active_class(if_route('back.configs.buildings.index')) }}">楼栋配置</a>
    <a href="{{ route('back.configs.purposes.index')}}" class="list-group-item list-group-item-action {{ active_class(if_route('back.configs.purposes.index')) }}">房源用途配置</a>
    <a href="{{ route('back.configs.rooms.index')}}" class="list-group-item list-group-item-action {{ active_class(if_route('back.configs.rooms.index')) }}">房间配置</a>
    <a href="{{ route('back.configs.prices.index')}}" class="list-group-item list-group-item-action {{ active_class(if_route('back.configs.prices.index')) }}">门店定价配置</a>
    <a href="{{ route('back.configs.accountingSubjects.index') }}" class="list-group-item list-group-item-action {{ active_class(if_route('back.configs.accountingSubjects.index')) }}">会计科目配置</a>
  </ul>
</div>
