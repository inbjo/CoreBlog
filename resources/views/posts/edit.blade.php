@extends('layouts.app')
@section('title',  '编辑文章')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/simditor/simditor.css') }}">
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
              <i class="icon paint brush"></i> 编辑文章
            </div>
            <div class="card-body">
              <!-- start navigation -->
            @include('layouts._msg')
            <!-- end navigation -->
              <form method="post" action="{{ route('post.update',$post->hash_id) }}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="form-group">
                  <label for="title">文章标题</label>
                  <input type="text"
                         class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                         id="title" name="title" placeholder="文章标题" value="{{ $post->title }}">
                  @if ($errors->has('title'))
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $errors->first('title') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="category">文章分类</label>
                  <select class="form-control" id="category" name="category_id">
                    @foreach($cats as $cat)
                      <option @if($cat->id == $post->category_id) selected @endif value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tags">文章标签</label>
                  <textarea class="form-control" id="tags" name="tags">{{ $tags }}</textarea>
                </div>
                <div class="form-group">
                  <label for="cover">封面图</label>
                  <input type="file" class="form-control dropify" id="cover" name="cover"
                         data-allowed-file-extensions="jpg jpeg png gif bmp webp" data-default-file="{{ $post->cover }}">
                </div>
                <div class="form-group">
                  <label for="content">文章内容</label>
                  <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                            id="content"
                            name="content" rows="6">{{ $post->content }}</textarea>
                  @if ($errors->has('content'))
                    <span class="invalid-feedback"
                          role="alert"><strong>{{ $errors->first('content') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <button type="submit" name="status" class="btn btn-primary" value="0">保存为草稿</button>
                  <button type="submit" name="status" class="btn btn-success" vlaue="1">发布</button>
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
  <script type="text/javascript" src="{{ asset('lib/simditor/module.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/simditor/hotkeys.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/simditor/uploader.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/simditor/simditor.js') }}"></script>
  <script>
    $(function () {

      $('#tags').tagator({
        autocomplete: ['php', 'vue', 'css', 'html', 'swoole', 'js']
      });

      $('#cover').dropify({
          messages: {
              'default': '单击此处或者拖动图片到此处',
              'replace': '单击此处或者拖动图片到此处更换图片',
              'remove':  '移除',
              'error':   '哦豁，发生了一点意外。'
          }
      });

      var editor = new Simditor({
        textarea: $('#content'),
        // defaultImage: '/images/demo.jpg',
        upload: {
          url: '{{ route('post.upload_image') }}',
          params: {
            _token: '{{ csrf_token() }}'
          },
          fileKey: 'upload_file',
          connectionCount: 3,
          leaveConfirm: '文件上传中，关闭此页面将取消上传。'
        },
        pasteImage: true,
      });
    });
  </script>
@endsection
