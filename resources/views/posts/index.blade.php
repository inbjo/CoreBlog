@extends('layouts.app')
@section('title', '文章管理 - '.sysConfig('SITE_NAME'))
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
              <a href="{{ route('setting.index')}}"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>
                系统设置</a>
            </li>
            <li class="list-group-item active">
              <a href="{{ route('post.manage') }}"><i class="fa fa-file-text fa-fw" aria-hidden="true"></i>
                文章管理</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('category.index') }}"><i class="fa fa-folder-open fa-fw" aria-hidden="true"></i>
                分类管理</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('link.index') }}"><i class="fa fa-link fa-fw" aria-hidden="true"></i>
                友链管理</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-file-text" aria-hidden="true"></i> 文章管理
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <div class="dropdown show mb-2">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  条件筛选
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{{route('post.manage',['type'=>'all'])}}" data-toggle="tooltip"
                     data-placement="right" title="不包含被删除的文章">所有文章</a>
                  <a class="dropdown-item" href="{{route('post.manage',['type'=>'published'])}}" data-toggle="tooltip"
                     data-placement="right" title="显示已被发表的文章">已发表的文章</a>
                  <a class="dropdown-item" href="{{route('post.manage',['type'=>'draft'])}}" data-toggle="tooltip"
                     data-placement="right" title="显示保存为草稿的文章">草稿箱文章</a>
                  <a class="dropdown-item" href="{{route('post.manage',['type'=>'recycle'])}}" data-toggle="tooltip"
                     data-placement="right" title="显示已被删除了的文章">回收站文章</a>
                </div>
              </div>

              <table class="table table-bordered table-hover table-sm">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">标题</th>
                  <th scope="col">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                  <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>
                      @if($type!='recycle')
                        <a href="{{ route('post.edit',$post->slug) }}" class="btn btn-default btn-sm">编辑</a>
                        <button class="btn btn-danger btn-sm delete" data-id="{{$post->id}}">删除</button>
                      @else
                        <button class="btn btn-default btn-sm restore" data-id="{{$post->id}}">恢复</button>
                        <button class="btn btn-danger btn-sm forceDelete" data-id="{{$post->id}}">彻底删除</button>
                      @endif
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>

              {{$posts->appends(['type' => $type])->links()}}

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
                  text: "删除后可从回收站恢复!",
                  icon: "warning",
                  buttons: ["取消操作", "确定删除"],
                  dangerMode: true,
              })
                  .then((willDelete) => {
                      if (willDelete) {
                          axios({
                              method: 'delete',
                              url: '/post/' + id
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

          $(".restore").click(function () {
              var id = $(this).data('id');
              swal({
                  title: "确定要恢复吗?",
                  text: "",
                  icon: "warning",
                  buttons: ["取消操作", "确定恢复"],
                  dangerMode: true,
              })
                  .then((willDelete) => {
                      if (willDelete) {
                          axios({
                              method: 'patch',
                              url: '/post/restore',
                              data: {
                                  'id': id
                              }
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

          $(".forceDelete").click(function () {
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
                              url: '/post/' + id,
                              data: {
                                  'force': true
                              }
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
