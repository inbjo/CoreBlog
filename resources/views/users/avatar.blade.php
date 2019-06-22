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
              <a href="{{ route('user.edit', auth()->user()->name) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                编辑资料</a>
            </li>
            <li class="list-group-item active">
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
              <i class="fa fa-picture-o" aria-hidden="true"></i> 更换头像
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->
              <div class="card-title">
                <div class="row">
                  <div class="col-2 d-flex justify-content-center align-items-center">
                    <b>当前头像</b>
                  </div>
                  <div class="col-10">
                    <img src="{{ Auth::user()->avatar }}" class="rounded-circle">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <img id="source" src=""/>
                </div>
                <div class="col-4">
                  <img id="preview" class="float-right" src=""/>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="file">更换头像</label>
                    <input type="file" name="avatar" class="form-control-file" id="file">
                  </div>
                  <div class="form-group">
                    <button id="btn-save" type="button" class="btn btn-primary">更换</button>
                  </div>
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

@section('scripts')
  <script>
    var image = document.getElementById('source');
    var cropper, canvas;

    $(function () {
      $('#file').change(function (e) {
        var file;
        var files = e.target.files;
        if (files && files.length > 0) {
          file = URL.createObjectURL(files[0]);
          $('#source').attr({'src': file})
        }
        cropper = new Cropper(image, {
          aspectRatio: 1,
          viewMode: 1,
          background: true,  //是否显示网格背景
          zoomable: false,   //是否允许放大图像
          guides: true,   //是否显示裁剪框虚线
          crop: function (event) { //剪裁框发生变化执行的函数。
            canvas = cropper.getCroppedCanvas({  //使用canvas绘制一个宽和高200的图片
              width: 200,
              height: 200,
            });
            $('#preview').attr("src", canvas.toDataURL("image/png", 0.3))  //使用canvas toDataURL方法把图片转换为base64格式
          }
        });
      });

      $("#btn-save").click(function () {
        var file = dataURLtoBlob($('#preview').attr("src"));  //将base64格式图片转换为文件形式
        var formData = new FormData();
        var newImg = new Date().getTime() + '.png';   //给图片添加文件名   如果没有文件名会报错
        formData.append('avatar', file, newImg); //formData对象添加文件
        formData.append('_method', 'PUT');
        $.ajax({
          type: "POST",
          url: "{{ route('user.avatar',auth()->user()->name) }}",
          data: formData,
          processData: false,  // 不处理数据
          contentType: false,  // 不设置内容类型
          success: function (data) {
            if (data.code == 0) {
              swal(data.msg, "", "success").then(function () {
                document.location.reload();
              });
            } else {
              swal(data.msg, "", "error");
            }
          }
        })
      });

    });

    function dataURLtoBlob(dataurl) {
      var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
      while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
      }
      return new Blob([u8arr], {type: mime});
    }
  </script>
@endsection
