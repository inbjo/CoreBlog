@extends('layouts.app')
@section('title', '修改密码 - '.config('system.name'))
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
            <li class="list-group-item">
              <a href="{{ route('user.edit', auth()->user()->name) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                编辑资料</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.avatar', auth()->user()->name) }}"><i class="fa fa-picture-o" aria-hidden="true"></i>
                更换头像</a>
            </li>
            <li class="list-group-item active">
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
              <i class="fa fa-lock" aria-hidden="true"></i> 修改密码
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <form method="post" action="{{ route('user.password', auth()->user()->name) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="name">密码</label>
                  <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                         name="password" placeholder="新密码">
                  @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="password-confirm">新密码</label>
                  <input type="password" class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" id="password-confirm"
                         name="password_confirmation" placeholder="再次输入新密码">
                  @if ($errors->has('password-confirm'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password-confirm') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">修改</button>
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
