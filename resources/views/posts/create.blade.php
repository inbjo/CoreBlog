@extends('layouts.app')
@section('title',  __('CreatePost'))

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/froala/css/froala_editor.pkgd.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/tagator/fm.tagator.jquery.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/dropify/dropify.min.css') }}">
@stop

@section('body')

  <!-- start navigation -->
  @include('layouts._nav')
  <!-- end navigation -->

  <!-- start site's main /content area -->
  <section class="content-wrap">
    <div class="container">
      <div class="row">
        <!-- start main area -->
        <div class="col-12">
          <div class="card mb-5">
            <div class="card-header text-center">
              <i class="icon paint brush"></i> {{__('CreatePost')}}
            </div>
            <div class="card-body">
              <!-- start navigation -->
            @include('layouts._msg')
            <!-- end navigation -->
              <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group">
                  <label for="title">文章标题</label>
                  <input type="text"
                         class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                         id="title"
                         name="title" placeholder="文章标题">
                  @if ($errors->has('title'))
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $errors->first('title') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="category">文章分类</label>
                  <select class="form-control" id="category" name="category_id">
                    @foreach($cats as $cat)
                      <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tags">文章标签</label>
                  <textarea class="form-control" id="tags" name="tags"></textarea>
                </div>
                <div class="form-group">
                  <label for="cover">封面图</label>
                  <input type="file" class="form-control dropify" id="cover" name="cover"
                         data-allowed-file-extensions="jpg jpeg png gif bmp webp">
                </div>
                <div class="form-group">
                  <label for="content">文章内容</label>
                  <div id="content"></div>
                </div>
                <div class="form-group">
                  <button type="button" id="btn-draft" class="btn btn-primary">保存为草稿</button>
                  <button type="button" id="btn-save" class="btn btn-success">发布</button>
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

@section('scripts')
  <script type="text/javascript" src="{{ asset('lib/tagator/fm.tagator.jquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/dropify/dropify.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/froala/js/froala_editor.pkgd.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/froala/js/languages/zh_cn.js') }}"></script>
  <script>
    var editor;
    $(function () {

      $('#tags').tagator({
        autocomplete: ['php', 'vue', 'css', 'html', 'swoole', 'js']
      });

      $('#cover').dropify({
        messages: {
          'default': '单击此处或者拖动图片到此处',
          'replace': '单击此处或者拖动图片到此处更换图片',
          'remove': '移除',
          'error': '哦豁，发生了一点意外。'
        }
      });

      $("#btn-save").click(function () {
        console.log(editor.html.get());
      });

      editor = new FroalaEditor('#content', {
        attribution: false,
        heightMin: 400,
        spellcheck: false,
        language: 'zh_cn',
        imageUploadURL: '/upload/image',
        fileUploadURL: '/upload/file',
        imageManagerLoadURL: '/upload/manager',
        imageManagerDeleteURL: '/upload/delete'
      });

      console.log(editor);

      // editor.opts.events['image.removed'] = function (e, editor, $img) {
      //
      // }

    });
  </script>
@endsection
