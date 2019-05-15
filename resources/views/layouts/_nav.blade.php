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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="userinfo" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                    <img src="{{ Auth::user()->avatar }}" class="img-fluid rounded-circle" width="30px"
                                         height="30px">
                                </span>
                                {{ Auth::user()->nickname }}<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userinfo">
                                <a href="{{ url('/') }}" class="dropdown-item">
                                     <i class="fas fa-user"></i>
                                     个人中心
                                 </a>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
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
