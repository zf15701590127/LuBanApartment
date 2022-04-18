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
          <li class="nav-item"><a class="nav-link {{ active_class(if_route('topics.index')) }}" href="{{ route('topics.index') }}">话题中心</a></li>
          <li class="nav-item"><a class="nav-link {{ active_class(if_route('roomManagements.index')) }}"  href="{{ route('roomManagements.index') }}">房态中心</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('topics.index') }}">运营管理</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('topics.index') }}">财务管理</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('topics.index') }}">报表管理</a></li>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
            @else
              <li class="nav-item">
                <a class="nav-link mt-1 me-3 font-weight-bold" href="{{ route('topics.create') }}">
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
                  <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">
                    <i class="far fa-user me-2"></i>
                    个人中心
                  </a>
                  <a class="dropdown-item" href="{{ route('users.foreUsersEdit', Auth::id()) }}">
                    <i class="far fa-edit me-2"></i>
                    编辑资料
                  </a>
                  <a class="dropdown-item" href="{{ route('users.index') }}">
                    <i class="fas fa-user-friends me-2"></i>
                    用户列表
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" id="logout" href="#">
                    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('您确定要退出吗？');">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <button class="btn btn-block btn-danger w-100" type="submit" name="button">退出</button>
                    </form>
                  </a>
                </div>
              </li>
            @endguest
         </ul>
      </div>
  </div>
  </nav>
