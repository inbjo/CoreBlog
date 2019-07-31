<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
    <div class="container">
        <!-- Branding Image -->
        <a class="navbar-brand " href="{{ url('/') }}">
            Blog
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">首页<span class="sr-only">当前</span></a>
                </li>
                @foreach($cats as $cat)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('category.show',$cat->slug)}}">{{$cat->name}}</a>
                    </li>
                @endforeach
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('post.create') }}">
                            <i class="fa fa-plus"></i>
                          </a>
                        </li>
                        <li class="nav-item notification-badge">
                            <a class="nav-link mr-3 badge badge-pill badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'secondary' }} text-white" href="{{ route('notifications.index') }}">
                                {{ Auth::user()->notification_count }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="userinfo" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                    <img src="{{ Auth::user()->avatar }}" class="img-fluid rounded-circle" width="30px"
                                         height="30px">
                                </span>
                                {{ Auth::user()->name }}<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userinfo">
                              @if(auth()->id() == 1)
                              <a href="{{ route('setting.index') }}" class="dropdown-item">
                                <i class="fa fa-cog fa-fw" aria-hidden="true"></i> 系统管理
                              </a>
                              <a href="{{ route('setting.clear') }}" class="dropdown-item">
                                <i class="fa fa-trash fa-fw" aria-hidden="true"></i> 清理缓存
                              </a>
                              @endif
                              <a href="{{ route('user.edit', auth()->user()->name) }}" class="dropdown-item">
                                  <i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> 编辑资料
                              </a>
                              <a href="{{ route('user.avatar', auth()->user()->name) }}" class="dropdown-item">
                                <i class="fa fa-picture-o fa-fw" aria-hidden="true"></i> 更换头像
                              </a>
                              <a href="{{ route('user.password', auth()->user()->name) }}" class="dropdown-item">
                                <i class="fa fa-lock fa-fw" aria-hidden="true"></i> 修改密码
                              </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" id="logout" href="#">
                                  <form action="{{ route('logout') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="btn btn-block btn-default btn-sm" type="submit" name="button">退出</button>
                                  </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
