@extends('layouts.app')
@section('title', '系统设置 - '.sysConfig('SITE_NAME'))
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
              <a href="{{ route('setting.index')}}"><i class="fa fa-cog" aria-hidden="true"></i>
                系统设置</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('post.manage') }}"><i class="fa fa-file-text" aria-hidden="true"></i>
                文章管理</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('category.index') }}"><i class="fa fa-folder-open" aria-hidden="true"></i>
                分类管理</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('link.index') }}"><i class="fa fa-link" aria-hidden="true"></i>
                友链管理</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-cog" aria-hidden="true"></i> 系统设置
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab"
                     aria-controls="nav-basic" aria-selected="true">基本设置</a>
                  <a class="nav-item nav-link" id="nav-mail-tab" data-toggle="tab" href="#nav-mail" role="tab"
                     aria-controls="nav-mail" aria-selected="false">邮件设置</a>
                  <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#redis" role="tab"
                     aria-controls="nav-redis" aria-selected="false">Redis设置</a>
                  <a class="nav-item nav-link" id="nav-pay-tab" data-toggle="tab" href="#nav-pay" role="tab"
                     aria-controls="nav-pay" aria-selected="false">支付设置</a>
                  <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#nav-other" role="tab"
                     aria-controls="nav-other" aria-selected="false">其他设置</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
                  <form class="mt-2" method="post" action="{{ route('setting.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="basic"/>
                    <div class="form-group">
                      <label for="APP_URL">博客网址</label>
                      <input type="text" class="form-control" id="APP_URL" placeholder="博客网址"
                             name="APP_URL" value="{{ config('app.url') }}">
                    </div>
                    <div class="form-group">
                      <label for="SITE_NAME">博客名称</label>
                      <input type="text" class="form-control" id="SITE_NAME" placeholder="博客名称"
                             name="SITE_NAME" value="{{ sysConfig('SITE_NAME') }}">
                    </div>
                    <div class="form-group">
                      <label for="SITE_SLOGAN">博客标语</label>
                      <input type="text" class="form-control" id="SITE_SLOGAN" placeholder="博客标语"
                             name="SITE_SLOGAN" value="{{ sysConfig('SITE_SLOGAN') }}">
                    </div>
                    <div class="form-group">
                      <label for="SITE_KEYWORD">博客关键词</label>
                      <input type="text" class="form-control" id="SITE_KEYWORD" placeholder="多个关键词以逗号分隔"
                             name="SITE_KEYWORD" value="{{ sysConfig('SITE_KEYWORD') }}">
                    </div>
                    <div class="form-group">
                      <label for="SITE_DESCRIPTION">博客描述</label>
                      <textarea class="form-control" name="SITE_DESCRIPTION" id="SITE_DESCRIPTION"
                                rows="3" placeholder="不要超过150个字">{{ sysConfig('SITE_DESCRIPTION') }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="SITE_ICP">ICP备案号</label>
                      <input type="text" class="form-control" id="SITE_ICP" placeholder="Icp备案号"
                             name="SITE_ICP" value="{{ sysConfig('SITE_ICP') }}">
                    </div>
                    <div class="form-group">
                      <label for="SITE_POLICE">公安备案号</label>
                      <input type="text" class="form-control" id="SITE_POLICE" placeholder="公安备案号"
                             name="SITE_POLICE" value="{{ sysConfig('SITE_POLICE') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="nav-mail" role="tabpanel" aria-labelledby="nav-mail-tab">
                  <form class="mt-2" method="post" action="{{ route('setting.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="mail"/>
                    <div class="form-group">
                      <label for="mail_drive">邮件驱动</label>
                      <select name="MAIL_DRIVER" class="form-control" id="mail_drive">
                        <option value="smtp" @if(config('mail.driver') == 'smtp') selected @endif>smtp</option>
                        <option value="sendmail" @if(config('mail.driver') == 'sendmail') selected @endif>sendmail
                        </option>
                        <option value="mailgun" @if(config('mail.driver') == 'mailgun') selected @endif>mailgun</option>
                        <option value="mandrill" @if(config('mail.driver') == 'mandrill') selected @endif>mandrill
                        </option>
                        <option value="ses" @if(config('mail.driver') == 'ses') selected @endif>ses</option>
                        <option value="sparkpost" @if(config('mail.driver') == 'sparkpost') selected @endif>sparkpost
                        </option>
                        <option value="postmark" @if(config('mail.driver') == 'postmark') selected @endif>postmark
                        </option>
                        <option value="log" @if(config('mail.driver') == 'log') selected @endif>log</option>
                        <option value="array" @if(config('mail.driver') == 'array') selected @endif>array</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="MAIL_FROM_ADDRESS">发信人邮箱</label>
                      <input type="text" class="form-control" id="MAIL_FROM_ADDRESS" placeholder="发信人邮箱地址"
                             name="MAIL_FROM_ADDRESS" value="{{ config('mail.from.address') }}">
                    </div>
                    <div class="form-group">
                      <label for="MAIL_FROM_NAME">发信人昵称</label>
                      <input type="text" class="form-control" id="MAIL_FROM_NAME" placeholder="发信人昵称"
                             name="MAIL_FROM_NAME" value="{{ config('mail.from.name') }}">
                    </div>
                    <div class="form-group">
                      <label for="MAIL_HOST">服务器地址</label>
                      <input type="text" class="form-control" id="MAIL_HOST" placeholder="邮件服务器地址"
                             name="MAIL_HOST" value="{{ config('mail.host') }}">
                    </div>
                    <div class="form-group">
                      <label for="MAIL_PORT">服务器端口</label>
                      <input type="text" class="form-control" id="MAIL_PORT" placeholder="服务器端口"
                             name="MAIL_PORT" value="{{ config('mail.port') }}">
                    </div>
                    <div class="form-group">
                      <label for="MAIL_USERNAME">用户名</label>
                      <input type="text" class="form-control" id="MAIL_USERNAME" placeholder="发信用户名"
                             name="MAIL_USERNAME" value="{{ config('mail.username') }}">
                    </div>
                    <div class="form-group">
                      <label for="MAIL_PASSWORD">密码</label>
                      <input type="password" class="form-control" id="MAIL_PASSWORD" placeholder="发信密码"
                             name="MAIL_PASSWORD" value="{{ config('mail.password') }}">
                    </div>
                    <div class="form-group">
                      <label for="MAIL_ENCRYPTION">加密协议</label>
                      <select name="MAIL_ENCRYPTION" class="form-control" id="MAIL_ENCRYPTION">
                        <option value="null" @if(config('mail.encryption') == 'null') selected @endif>不加密</option>
                        <option value="tls" @if(config('mail.encryption') == 'tls') selected @endif>tls</option>
                        <option value="ssl" @if(config('mail.encryption') == 'ssl') selected @endif>ssl</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="redis" role="tabpanel" aria-labelledby="nav-redis">
                  <form class="mt-2" method="post" action="{{ route('setting.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="redis"/>
                    <div class="form-group">
                      <label for="REDIS_HOST">Redis服务器地址</label>
                      <input type="text" class="form-control" id="REDIS_HOST" placeholder="Redis服务器地址"
                             name="REDIS_HOST" value="{{ config('database.redis.default.host') }}">
                    </div>
                    <div class="form-group">
                      <label for="REDIS_PASSWORD">Redis密码</label>
                      <input type="password" class="form-control" id="REDIS_PASSWORD" placeholder="无密码请留空"
                             name="REDIS_PASSWORD" value="{{ config('database.redis.default.password') }}">
                    </div>
                    <div class="form-group">
                      <label for="REDIS_PORT">Redis端口</label>
                      <input type="text" class="form-control" id="REDIS_PORT" placeholder="Redis端口"
                             name="REDIS_PORT" value="{{ config('database.redis.default.port') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                  </form>
                </div>
                <div class="tab-pane fade show" id="nav-pay" role="tabpanel" aria-labelledby="nav-pay-tab">
                  <form class="mt-2" method="post" action="{{ route('setting.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="pay"/>
                    <div class="form-group">
                      <label for="ALI_APP_ID">支付宝APPID</label>
                      <input type="text" class="form-control" id="ALI_APP_ID" placeholder="支付宝APPID"
                             name="ALI_APP_ID" value="{{ sysConfig('ALI_APP_ID') }}">
                    </div>
                    <div class="form-group">
                      <label for="ALI_PUBLIC_KEY">支付宝公钥</label>
                      <textarea class="form-control" name="ALI_PUBLIC_KEY" id="ALI_PUBLIC_KEY" rows="5"
                                placeholder="支付宝公钥(支付宝提供的公钥)">{{ sysConfig('ALI_PUBLIC_KEY') }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="ALI_PRIVATE_KEY">支付宝私钥</label>
                      <textarea class="form-control" name="ALI_PRIVATE_KEY" id="ALI_PRIVATE_KEY" rows="6"
                                placeholder="支付宝私钥(用户自行生成的私钥)">{{ sysConfig('ALI_PRIVATE_KEY') }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="WECHAT_APP_ID">微信公众号APPID</label>
                      <input type="text" class="form-control" id="WECHAT_APP_ID" placeholder="微信公众号APPID"
                             name="WECHAT_APP_ID" value="{{ sysConfig('WECHAT_APP_ID') }}">
                    </div>
                    <div class="form-group">
                      <label for="WECHAT_MCH_ID">微信商户号</label>
                      <input type="text" class="form-control" id="WECHAT_MCH_ID" placeholder="微信商户号"
                             name="WECHAT_MCH_ID" value="{{ sysConfig('WECHAT_MCH_ID') }}">
                    </div>
                    <div class="form-group">
                      <label for="WECHAT_KEY">微信支付秘钥</label>
                      <input type="text" class="form-control" id="WECHAT_KEY" placeholder="微信支付秘钥"
                             name="WECHAT_KEY" value="{{ sysConfig('WECHAT_KEY') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">
                  <form class="mt-2" method="post" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="other"/>
                    <div class="form-group">
                      <label for="AllOW_USER_CREATE_POST">文章设置</label>
                      <select name="AllOW_USER_CREATE_POST" class="form-control" id="AllOW_USER_CREATE_POST">
                        <option value="false" @if(sysConfig('AllOW_USER_CREATE_POST') == 'false') selected @endif>禁止普通用户发表文章
                        </option>
                        <option value="true" @if(sysConfig('AllOW_USER_CREATE_POST') == 'true') selected @endif>允许普通用户发表文章
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="VERIFY_COMMENT">评论人机验证</label>
                      <select name="VERIFY_COMMENT" class="form-control" id="VERIFY_COMMENT">
                        <option value="false" @if(sysConfig('VERIFY_COMMENT') == 'false') selected @endif>关闭
                        </option>
                        <option value="true" @if(sysConfig('VERIFY_COMMENT') == 'true') selected @endif>开启
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="VAPTCHA_VID">Vaptcha VID <a href="https://www.vaptcha.com/">Vaptcha官网</a></label>
                      <input type="text" class="form-control" id="VAPTCHA_VID" placeholder="VAPTCHA VID"
                             name="VAPTCHA_VID" value="{{ sysConfig('VAPTCHA_VID') }}">
                    </div>
                    <div class="form-group">
                      <label for="VAPTCHA_KEY">Vaptcha key</label>
                      <input type="text" class="form-control" id="VAPTCHA_KEY" placeholder="VAPTCHA KEY"
                             name="VAPTCHA_KEY" value="{{ sysConfig('VAPTCHA_KEY') }}">
                    </div>
                    <div class="form-group">
                      <label for="STAT_CODE">统计代码</label>
                      <textarea class="form-control" name="STAT_CODE" id="STAT_CODE" rows="5"
                                placeholder="第三方js统计代码">{{ sysConfig('STAT_CODE') }}</textarea>
                    </div>
                    <div class="form-group">
                      <label for="WATERMARK">图片水印</label>
                      <select name="WATERMARK" class="form-control" id="WATERMARK">
                        <option value="false" @if(sysConfig('WATERMARK') == 'false') selected @endif>关闭
                        </option>
                        <option value="true" @if(sysConfig('WATERMARK') == 'true') selected @endif>开启
                        </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="WATERMARK_IMAGE">水印图片</label>
                      <input type="file" class="form-control" id="WATERMARK_IMAGE" placeholder="水印文字"
                             name="WATERMARK_IMAGE">
                    </div>
                    <div class="form-group">
                      <label>水印图片预览</label>
                      <img class="img-thumbnail" src="{{ sysConfig('WATERMARK_IMAGE') }}" alt="">
                    </div>
                    <button type="submit" class="btn btn-primary">保存</button>
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
