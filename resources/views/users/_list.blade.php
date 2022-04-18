<div class="col-lg-3 col-md-3">
  <ul class="list-group">
    <a href="{{ route('users.foreUsersEdit', Auth::id()) }}" class="list-group-item list-group-item-action {{ active_class(if_route('users.foreUsersEdit')) }}""><i class="fa fa-list"></i> 个人信息</a>
    <a href="{{ route('passwords.edit', Auth::id()) }}" class="list-group-item list-group-item-action {{ active_class(if_route('passwords.edit')) }}""><i class="fa fa-lock"></i> 修改密码</a>
  </ul>
</div>
