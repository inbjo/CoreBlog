@extends('layouts.app')
@section('title',  __('CreatePost'))
@section('body')

  <!-- start navigation -->
  @include('blog._nav')
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
              <form method="post" action="{{ route('post.create') }}">
                @csrf
                <div class="form-group">
                  <label for="title">文章标题</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="文章标题">
                </div>
                <div class="form-group">
                  <label for="category">文章分类</label>
                  <select class="form-control" id="category" name="category">
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
                  <textarea class="form-control" id="content" name="content" rows="6"></textarea>
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
  @include('blog._footer')
  <!-- end main-footer -->

@endsection

@section('script')
  @parent
  <script>
    $(function() {
      var editor = editormd("editor", {
        width: "100%",
        height: "100%",
        // markdown: "xxxx",     // dynamic set Markdown text
        path : "editor.md/lib/"  // Autoload modules mode, codemirror, marked... dependents libs path
      });
    });
  </script>
@endsection
