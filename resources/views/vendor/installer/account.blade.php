@extends('vendor.installer.layouts.master')

@section('template_title')
  设置管理员账号
@endsection

@section('title')
  <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
  设置管理员账号
@endsection

@section('container')
  <div class="container">
    <form method="POST" action="{{ route('install.store') }}">
      @csrf

      <div class="form-group">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
        <div class="col-md-6">
          <input id="name" type="text" class="form-control" name="name" pattern="[0-9a-zA-Z_]{1,}" required autofocus
                 placeholder="请使用英文数字下划线">
        </div>
      </div>

      <div class="form-group">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        <div class="col-md-6">
          <input id="email" type="text" class="form-control" name="email"
                 pattern="^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$"
                 required placeholder="请填写您的常用邮件地址">
        </div>
      </div>

      <div class="form-group">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        <div class="col-md-6">
          <input id="password" type="password" class="form-control" name="password"
                 minlength="8" required placeholder="长度8位以上">
        </div>
      </div>

      <div class="form-group">
        <p class="text-center">
          <button type="submit" class="button button-wizard">
            完成设置
          </button>
        </p>
      </div>

    </form>
  </div>

@endsection
