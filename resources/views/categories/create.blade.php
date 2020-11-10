@extends('layouts.app')
@section('title', '添加分类 - '.sysConfig('SITE_NAME'))
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
            <li class="list-group-item  active">
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
              <i class="fa fa-folder-open" aria-hidden="true"></i> 添加分类
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="name">分类名称</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="请输入分类名称" required>
                </div>
                <div class="form-group">
                  <label for="slug">Url别名</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="请输入Url别名" required>
                </div>
                <div class="form-group">
                  <label for="sort">排序</label>
                  <input type="number" class="form-control" id="sort" name="sort" placeholder="越小越靠前" required>
                </div>
                <div class="form-group">
                  <label for="description">分类描述</label>
                  <textarea name="description" class="form-control" id="description" rows="4"
                            placeholder="不要超过150字" required></textarea>
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