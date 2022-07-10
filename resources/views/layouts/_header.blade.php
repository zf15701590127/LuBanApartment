<nav class="navbar navbar-expand-lg navbar-light navbar-static-top">
  <div class="container">
      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ url('/') }}">
      LuBanYu
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link {{ active_class(if_route('fore.topics.topics.index')) }}" href="{{ route('fore.topics.topics.index') }}">话题中心</a></li>
          <li class="nav-item"><a class="nav-link {{ active_class(if_route('fore.rooms.rooms.index')) }}"  href="{{ route('fore.rooms.rooms.index') }}">房态中心</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('fore.reserves.reserves.index') }}">运营管理</a></li>
          <li class="nav-item"><a class="nav-link" href="">财务管理</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('fore.reports.payments.index') }}">报表管理</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav navbar-right">
            <!-- Authentication Links -->
            <li class="nav-item">
              <a class="nav-link mt-1 me-3 font-weight-bold" href="{{ route('fore.topics.topics.create') }}">
                <i class="fa-solid fa-plus"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ Auth::user()->avatar }}"
                  class="img-responsive img-circle" width="30px" height="30px">
                {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('fore.users.users.show', Auth::id()) }}">
                  <i class="far fa-user me-2 fa-fw"></i>
                  个人中心
                </a>
                <a class="dropdown-item" href="{{ route('fore.users.users.edit', Auth::id()) }}">
                  <i class="far fa-edit me-2 fa-fw"></i>
                  编辑资料
                </a>
                @can('is_admin', Auth::user())
                  <a class="dropdown-item" href="{{ route('back.users.users.index') }}">
                    <i class="fas fa-user-friends me-2 fa-fw"></i>
                    用户列表
                  </a>
                  <a class="dropdown-item" href="{{ route('back.configs.projects.index') }}">
                    <i class="fa fa-cog me-2 fa-fw"></i>
                    配置中心
                  </a>
                @endcan
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" id="logout" href="#">
                  <form action="{{ route('fore.sessions.sessions.destroy') }}" method="POST" onsubmit="return confirm('您确定要退出吗？');">
                    {{ csrf_field() }}
                    @method('delete')
                    <button class="btn btn-block btn-danger w-100" type="submit" name="button">退出</button>
                  </form>
                </a>
              </div>
            </li>
         </ul>
      </div>
  </div>
  </nav>
