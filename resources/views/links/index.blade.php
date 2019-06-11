@extends('layouts.app')
@section('title', '友链管理 - '.config('system.name'))
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
              <i class="fa fa-link" aria-hidden="true"></i> 友链管理
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <a href="{{ route('link.create') }}" class="btn btn-default btn-sm mb-2">添加友链</a>
              <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">友链名称</th>
                  <th scope="col">友链网址</th>
                  <th scope="col">排序</th>
                  <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($links as $link)
                  <tr>
                    <th scope="row">{{ $link->id }}</th>
                    <td>{{ $link->name }}</td>
                    <td>{{ $link->url }}</td>
                    <td>{{ $link->sort }}</td>
                    <td>
                      <a href="{{ route('link.edit',$link->id) }}" class="btn btn-default btn-sm">编辑</a>
                      <button class="btn btn-danger btn-sm delete" data-id="{{$link->id}}">删除</button>
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

@section('scripts')
  <script>
    $(function () {
      $(".delete").click(function () {
        var id = $(this).data('id');
        swal({
          title: "确定要删除吗?",
          text: "一旦删除无法恢复!",
          icon: "warning",
          buttons: ["取消操作", "确定删除"],
          dangerMode: true,
        })
          .then((willDelete) => {
            if (willDelete) {
              axios({
                method: 'delete',
                url: '/link/' + id
              }).then(function (response) {
                swal(response.data.msg, {
                  icon: response.data.code == 0 ? "success" : "error",
                }).then(function () {
                  if (response.data.code == 0) {
                    document.location.reload();
                  }
                });
              });
            }
          });
      });
    });
  </script>
@endsection
