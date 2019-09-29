@extends('layouts.app')
@section('title', '账号关联 - '.sysConfig('SITE_NAME'))
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
              <a href="{{ route('user.paycode', auth()->user()->name) }}"><i class="fa fa-qrcode" aria-hidden="true"></i>
                打赏收款</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.avatar', auth()->user()->name) }}"><i class="fa fa-picture-o" aria-hidden="true"></i>
                更换头像</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.password', auth()->user()->name) }}"><i class="fa fa-lock" aria-hidden="true"></i> 修改密码</a>
            </li>
            <li class="list-group-item active">
              <a href="{{ route('user.binding', auth()->user()->name) }}"><i class="fa fa-user-plus" aria-hidden="true"></i> 账号关联</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-user-plus" aria-hidden="true"></i> 账号关联
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <form method="post" action="{{ route('user.binding', auth()->user()->name) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="qq">QQ</label>
                  <input type="number" class="form-control{{ $errors->has('qq') ? ' is-invalid' : '' }}" id="qq"
                         name="qq" placeholder="QQ号" value="{{ $user->extend->qq ?? '' }}">
                  @if ($errors->has('qq'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('qq') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="wechat">微信二维码</label>
                  <input type="file" name="wechat" class="form-control-file mb-2" id="wechat">
                  <input type="text" class="form-control" value="{{ $user->extend->wechat ?? '' }}" disabled
                         placeholder="当前未上传微信二维码">
                </div>
                <div class="form-group">
                  <label for="weibo">微博</label>
                  <input type="url" class="form-control{{ $errors->has('weibo') ? ' is-invalid' : '' }}" id="weibo"
                         name="weibo" placeholder="微博地址" value="{{ $user->extend->weibo ?? '' }}">
                  @if ($errors->has('weibo'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('weibo') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="github">Github</label>
                  <input type="url" class="form-control{{ $errors->has('github') ? ' is-invalid' : '' }}" id="github"
                         name="github" placeholder="github地址" value="{{ $user->extend->github ?? '' }}">
                  @if ($errors->has('github'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('github') }}</strong></span>
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
