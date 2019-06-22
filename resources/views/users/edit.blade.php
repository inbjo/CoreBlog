@extends('layouts.app')
@section('title', '编辑资料 - '.config('system.name'))
@section('body')

  <!-- start navigation -->
  @include('layouts._nav')
  <!-- end navigation -->

  <!-- start site's main /content area -->
  <section class="content-wrap">
    <div class="container">
      <div id="profile" class="row">
        <!-- start main area -->
        <div class="col-3">
          <ul class="list-group text-center">
            <li class="list-group-item active">
              <a href="{{ route('user.edit', auth()->user()->name) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                编辑资料</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.avatar', auth()->user()->name) }}"><i class="fa fa-picture-o" aria-hidden="true"></i>
                更换头像</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.password', auth()->user()->name) }}"><i class="fa fa-lock" aria-hidden="true"></i> 修改密码</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.binding', auth()->user()->name) }}"><i class="fa fa-user-plus" aria-hidden="true"></i> 账号关联</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑资料
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <form method="post" action="{{ route('user.update',auth()->user()->name) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="name">用户名</label>
                  <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"
                         name="name" placeholder="昵称" value="{{ Auth::user()->name }}">
                  @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="email">邮箱</label>
                  <input type="email" class="form-control" id="email" name="email" readonly
                         value="{{ Auth::user()->email }}"/>
                  <small id="emailHelp" class="form-text text-muted">邮箱暂不支持更改</small>
                </div>
                <div class="form-group">
                  <label for="mobile">手机号</label>
                  <input type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" id="mobile"
                         name="mobile" placeholder="手机号" value="{{ Auth::user()->mobile }}">
                  @if ($errors->has('mobile'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('mobile') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="bio">个性签名</label>
                  <textarea class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" id="bio" rows="4"
                            name="bio">{{ Auth::user()->bio }}</textarea>
                  @if ($errors->has('bio'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('bio') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">保存</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end main area -->
      </div>
    </div>
  </section>
  <!-- end site's main /content area -->

  <!-- start main-footer -->
  @include('layouts._footer')
  <!-- end main-footer -->

@endsection
