@extends('layouts.app')
@section('title', '编辑友链 - '.config('system.name'))
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
              <a href="{{ route('setting.index')}}"><i class="fa fa-cog" aria-hidden="true"></i>
                系统设置</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('category.index') }}"><i class="fa fa-folder-open" aria-hidden="true"></i>
                分类管理</a>
            </li>
            <li class="list-group-item active">
              <a href="{{ route('link.index') }}"><i class="fa fa-link" aria-hidden="true"></i>
                友链管理</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-folder-open" aria-hidden="true"></i> 编辑友链
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <form action="{{ route('link.update',$link->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="name">友链名称</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{$link->name}}" required>
                </div>
                <div class="form-group">
                  <label for="url">友链网址</label>
                  <input type="url" class="form-control" id="url" name="url" value="{{$link->url}}" required>
                </div>
                <div class="form-group">
                  <label for="sort">排序</label>
                  <input type="number" class="form-control" id="sort" name="sort" value="{{$link->sort}}" required>
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
                <a href="javascript:history.go(-1);" class="btn btn-secondary">返回</a>
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
