@extends('layouts.app')
@section('title', '打赏收款 - '.sysConfig('SITE_NAME'))
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
              <a href="{{ route('user.edit', auth()->user()->name) }}">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                编辑资料</a>
            </li>
            <li class="list-group-item active">
              <a href="{{ route('user.paycode', auth()->user()->name) }}">
                <i class="fa fa-qrcode" aria-hidden="true"></i>
                打赏收款</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.avatar', auth()->user()->name) }}">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
                更换头像</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.password', auth()->user()->name) }}">
                <i class="fa fa-lock" aria-hidden="true"></i>
                修改密码</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('user.binding', auth()->user()->name) }}">
                <i class="fa fa-user-plus" aria-hidden="true"></i> 账号关联</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-qrcode" aria-hidden="true"></i> 打赏收款
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->
              <div class="row">
                <div class="col-12">
                  <form action="{{route('user.paycode',auth()->user()->name)}}" method="post"
                        enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label for="reward">打赏功能</label>
                      <select name="reward" class="form-control" id="reward">
                        <option value="false" @if($reward == 'false') selected @endif>关闭</option>
                        <option value="true" @if($reward == 'true') selected @endif>开启</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="alipay_paycode">支付宝收款码</label>
                      <input type="file" name="alipay_paycode" class="form-control-file mb-2" id="alipay_paycode">
                      <input type="text" class="form-control" value="{{ $user->extend->alipay_paycode ?? '' }}" disabled
                             placeholder="当前未上传支付宝收款码">
                    </div>
                    <div class="form-group">
                      <label for="wechat_paycode">微信收款码</label>
                      <input type="file" name="wechat_paycode" class="form-control-file mb-2" id="wechat_paycode">
                      <input type="text" class="form-control" value="{{ $user->extend->wechat_paycode ?? '' }}" disabled
                             placeholder="当前未上传微信收款码">
                    </div>
                    <div class="form-group">
                      <label for="qq_paycode">QQ收款码</label>
                      <input type="file" name="qq_paycode" class="form-control-file mb-2" id="qq_paycode">
                      <input type="text" class="form-control" value="{{ $user->extend->qq_paycode ?? '' }}" disabled
                             placeholder="当前未上传QQ收款码">
                    </div>
                    <div class="form-group">
                      <button id="btn-save" type="submit" class="btn btn-primary">保存</button>
                    </div>
                  </form>
                </div>
              </div>
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
