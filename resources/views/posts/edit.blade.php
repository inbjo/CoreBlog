@extends('layouts.app')
@section('title',  '编辑文章 - '.config('system.name'))

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/editormd/css/editormd.min.css') }}">
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
              <form id="post" method="post" action="{{ route('post.update',$post->slug) }}"
                    enctype="multipart/form-data">
                @method('PUT')
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
                      <option @if($cat->id == $post->category_id) selected
                              @endif value="{{$cat->id}}">{{$cat->name}}</option>
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
                         data-allowed-file-extensions="jpg jpeg png gif bmp webp"
                         data-default-file="{{ $post->cover }}">
                </div>
                <div class="form-group">
                  <label for="description">文章描述</label>
                  <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="请简要概述大概内容，不要超过150字" maxlength="150">{{ $post->description }}</textarea>
                </div>
                <div class="form-group" id="editor">
                  <textarea name="content" id="content" class="form-control">{!! $post->getOriginal('content') !!}</textarea>
                </div>
                <div class="form-group">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="publish" value="1"
                           @if($post->status == 1) checked @endif>
                    <label class="form-check-label" for="publish">
                      直接发布
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="draft" value="0"
                           @if($post->status == 0) checked @endif>
                    <label class="form-check-label" for="draft">
                      保存为草稿
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">提交</button>
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
  <script type="text/javascript" src="{{ asset('lib/editormd/editormd.min.js') }}"></script>
  <script>
    $(function () {

      $('#tags').tagator({
        autocomplete: {!! $alltags !!}
      });

      $('#cover').dropify({
        messages: {
          'default': '单击此处或者拖动图片到此处',
          'replace': '单击此处或者拖动图片到此处更换图片',
          'remove': '移除',
          'error': '哦豁，发生了一点意外。'
        }
      });

      var editor = editormd("editor", {
        width: "100%",
        height: "500px",
        // lineNumbers:false,
        // markdown:'',
        watch : false,
        codeFold : true,
        placeholder:"请在这撰写您的文章内容...",
        taskList: true,
        emoji:true,
        flowChart: true,
        sequenceDiagram: true,
        imageUpload: true,
        imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
        imageUploadURL : "{{ route('upload.store') }}",
        path : "/lib/editormd/lib/"
      });



    });
  </script>
@endsection
