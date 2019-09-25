<!doctype html>
<html lang="zh-cn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{$data['title']}} - {{sysConfig('SITE_NAME')}}</title>
  <link rel="stylesheet" href="/css/weui.min.css">
  <style>
    body, .weui-msg {
      background: #ebebeb;
    }
  </style>
</head>
<body>

<div class="weui-msg">
  <div class="weui-msg__icon-area">
    @if($data['status'] == 'success')
      <i class="weui-icon-success  weui-icon_msg"></i>
    @else
      <i class="weui-icon-warn  weui-icon_msg"></i>
    @endif
  </div>
  <div class="weui-msg__text-area">
    <h2 class="weui-msg__title">{{$data['title']}}</h2>
    <p class="weui-msg__desc">{{$data['content']}}</p>
  </div>
  <div class="weui-msg__opr-area">
    <p class="weui-btn-area">
      <a href="javascript:closePage();" class="weui-btn weui-btn_primary">关闭页面</a>
    </p>
  </div>
</div>

<div class="weui-footer weui-footer_fixed-bottom">
  <p class="weui-footer__text">Copyright © <a href="https://github.com/inbjo/CoreBlog">CoreBlog</a> All right Reserved.
  </p>
</div>

</body>
<script>
    function closePage() {
        var userAgent = navigator.userAgent;
        if (userAgent.indexOf("MicroMessenger") != -1) {
            WeixinJSBridge.call('closeWindow');
        }
        if (userAgent.indexOf("Firefox") != -1 || userAgent.indexOf("Chrome") != -1) {
            window.location.href = "about:blank";
        } else if (userAgent.indexOf('Android') > -1 || userAgent.indexOf('Linux') > -1) {
            window.opener = null;
            window.open('about:blank', '_self', '').close();
        } else {
            window.opener = null;
            window.open("about:blank", "_self");
            window.close();
        }
    }
</script>
</html>
