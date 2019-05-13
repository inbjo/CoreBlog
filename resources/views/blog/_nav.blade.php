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
                                <a href="{{ route('post.create')}}" class="dropdown-item">
                                    <i class="fas fa-user"></i>
                                    发表博文
                                </a>
                                {{-- <a href="{{ route('users.show', Auth::id()) }}" class="dropdown-item">
                                     <i class="fas fa-user"></i>
                                     个人中心
                                 </a>
                                 <a href="{{ route('users.edit', Auth::id()) }}" class="dropdown-item">
                                     <i class="fas fa-edit"></i>
                                     编辑资料
                                 </a>--}}
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
