<div class="col-lg-3 col-md-3">
  <ul class="list-group list-group-flush rounded-3">
    <a href="{{ route('fore.users.users.edit', Auth::id()) }}" class="list-group-item list-group-item-action {{ active_class(if_route('fore.users.users.edit')) }}""><i class="fa fa-list"></i> 个人信息</a>
    <a href="{{ route('fore.passwords.passwords.edit', Auth::id()) }}" class="list-group-item list-group-item-action {{ active_class(if_route('fore.passwords.passwords.edit')) }}""><i class="fa fa-lock"></i> 修改密码</a>
  </ul>
</div>
