@extends('layouts.app')
@section('title', '更换头像 - '.config('system.name'))
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
              <a href="{{ route('user.edit', Auth::id()) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                编辑资料</a>
            </li>
            <li class="list-group-item active">
              <a href="{{ route('user.avatar', Auth::id()) }}"><i class="fa fa-picture-o" aria-hidden="true"></i>
                更换头像</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.password', Auth::id()) }}"><i class="fa fa-lock" aria-hidden="true"></i> 修改密码</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.binding', Auth::id()) }}"><i class="fa fa-user-plus" aria-hidden="true"></i> 账号关联</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-picture-o" aria-hidden="true"></i> 更换头像
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->
              <div class="card-title">
                <img src="{{ Auth::user()->avatar }}" class="rounded-circle">
              </div>
              <form method="post" action="{{ route('user.avatar',Auth::id()) }}" accept-charset="UTF-8"
                    enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="avatar">头像</label>
                  <input type="file" name="avatar" class="form-control-file" id="avatar">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">更换</button>
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
