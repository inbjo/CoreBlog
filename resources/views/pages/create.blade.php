@extends('layouts.app')
@section('title',  __('CreatePost'))

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/simditor/simditor.css') }}">
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
              <i class="icon paint brush"></i> 发表博文
            </div>
            <div class="card-body">
              <!-- start navigation -->
              @include('layouts._msg')
              <!-- end navigation -->
              <form method="post" action="{{ route('post.create') }}">
                @csrf
                <div class="form-group">
                  <label for="title">文章标题</label>
                  <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title"
                         name="title" placeholder="文章标题">
                  @if ($errors->has('title'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('title') }}</strong></span>
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
                  <textarea class="form-control" id="tags" rows="2" name="tags"></textarea>
                </div>
                <div class="form-group">
                  <label for="content">文章内容</label>
                  <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content"
                            name="content" rows="6"></textarea>
                  @if ($errors->has('content'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('content') }}</strong></span>
                  @endif
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">保存为草稿</button>
                  <button type="submit" class="btn btn-success">发布</button>
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
  @parent
  <script type="text/javascript" src="{{ asset('lib/simditor/module.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/simditor/hotkeys.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/simditor/uploader.js') }}"></script>
  <script type="text/javascript" src="{{ asset('lib/simditor/simditor.js') }}"></script>
  <script>
    $(function () {
      var editor = new Simditor({
        textarea: $('#content'),
        defaultImage: '/images/demo.jpg',
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
