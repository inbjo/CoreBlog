@extends('layouts.app')
@section('title', '分类管理')
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
              <i class="fa fa-folder-open" aria-hidden="true"></i> 分类管理
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->
              <button class="btn btn-default btn-sm mb-2">添加分类</button>
              <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">分类名称</th>
                  <th scope="col">slug</th>
                  <th scope="col">排序</th>
                  <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorys as $category)
                <tr>
                  <th scope="row">{{ $category->id }}</th>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->slug }}</td>
                  <td>{{ $category->sort }}</td>
                  <td>
                    <button class="btn btn-default btn-sm">编辑</button>
                    <button class="btn btn-danger btn-sm">删除</button>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>


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
