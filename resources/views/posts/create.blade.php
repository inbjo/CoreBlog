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
              <form id="post" method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
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
                  <textarea name="content" id="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="publish" value="1" checked>
                    <label class="form-check-label" for="publish">
                      直接发布
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="draft" value="0">
                    <label class="form-check-label" for="draft">
                      保存为草稿
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" data-status="1" class="btn btn-success">提交</button>
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

      editor = new FroalaEditor('#content', {
        attribution: false,
        heightMin: 400,
        spellcheck: false,
        language: 'zh_cn',
        imageUploadURL: '{{ route('upload.store') }}',
        fileUploadURL: '{{ route('upload.store') }}',
        videoUploadURL: '{{ route('upload.store') }}',
        imageManagerLoadURL: '{{ route('upload.index') }}',
        imageManagerDeleteMethod: 'DELETE',
        imageManagerDeleteURL: '{{ route('upload.destroy') }}',
        imageMaxSize: 1024 * 1024 * 10,
        videoMaxSize: 1024 * 1024 * 50,
        fileMaxSize: 1024 * 1024 * 50,
        imageUploadParams: {
          _token: document.head.querySelector('meta[name="csrf-token"]').content
        },
        fileUploadParams: {
          _token: document.head.querySelector('meta[name="csrf-token"]').content
        },
        videoUploadParams: {
          _token: document.head.querySelector('meta[name="csrf-token"]').content
        },
        imageManagerDeleteParams: {
          _token: document.head.querySelector('meta[name="csrf-token"]').content
        },
        events: {
          'image.removed': function ($img) {
            editor_remove(location.origin + $img.attr('src'));
          },
          'file.unlink': function (link) {
            editor_remove(link.href);
          },
          'video.removed': function ($video) {
            editor_remove($video.find('video')[0].src);
          }
        }
      });

    });

    function editor_remove(link) {
      axios({
        method: 'delete',
        url: '{{ route('upload.destroy') }}',
        data: {
          link: link
        }
      }).then(function (response) {
        console.log(response.data.msg)
      });
    }
  </script>
@endsection
