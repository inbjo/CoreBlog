@extends('layouts.app')
@section('title', $post->title)
@section('keyword', $post->keyword)
@section('description', $post->description)

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('lib/tribute/tribute.css') }}">
@stop

@section('body')

  <!-- start navigation -->
  @include('layouts._nav')
  <!-- end navigation -->

  <!-- start site's main /content area -->
  <section class="content-wrap">
    <div class="container">
      <div class="row">
        <!-- start main post area -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 main-content">
          <!-- start message tips -->
        @include('layouts._msg')
        <!-- end message tips -->

          <!-- start post -->
          <article class="post page">
            <div class="post-head">
              <h3 class="post-title">{{$post->title}}</h3>
              <div class="post-meta">
                                <span class="author">By
                                    <a href="{{route('user.show',$post->user->id)}}"
                                       title="查看该作者发布的所有文章">{{$post->user->name}}</a>
                                </span> &bull;
                <span class="date" title="{{ $post->created_at->toDateTimeString() }}">
                                    {{$post->created_at->diffForHumans() }}
                                </span>&bull;
                <span class="comment-count">
                                    <a href="{{route('post.show',$post->user->id)}}#comments">{{$post->comment_count}}条评论</a>
                                </span>
              </div>
            </div>
            @if($post->cover)
              <div class="featured-media">
                <img src="{{$post->cover}}" alt="{{$post->title}}">
              </div>
            @endif
            <div class="post-content">
              {!! $post->content !!}
            </div>
            @can('update', $post)
              <div class="post-action clearfix">
                <button id="delete" class="btn btn-danger btn-sm float-right">删除</button>
                <a href="{{ route('post.edit',$post->hash_id) }}" class="btn btn-primary btn-sm float-right mr-2">编辑</a>
              </div>
            @endcan
            <footer class="post-footer clearfix">
              <div class="float-left tag-list">
                <i class="fa fa-tag"></i>
                @foreach($post->tags as $tag)
                  @if ($loop->last)
                    <a href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>
                  @else
                    <a href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>,
                  @endif
                @endforeach
              </div>
              <div class="float-right share">
                <ul class="share-icons">
                  <!-- twitter -->
                  <li>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <!-- facebook -->
                  <li>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <!-- google plus -->
                  <li>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                  </li>
                  <!-- pinterest -->
                  <li>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                  </li>
                  <!-- linkedin -->
                  <li>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
                </ul>
              </div>
            </footer>
          </article>
          <!-- end post -->

          <!--start comments -->
          <div class="post-comment-bar" id="comments" name="comments">
            <h4 class="mb-0">
                <span class="badge badge-primary">
                   <i class="fa fa-comments" aria-hidden="true"></i> 评论
                </span>
            </h4>
            <div class="clearfix"></div>
            <div id="comment_tips">+1</div>
          </div>
          @forelse ($comments as $key=> $comment)
            <div class="post-comment media" name="comment_{{$key+1}}">
              <img class="mr-3 avatar rounded-circle" src="{{$comment->user->avatar}}" alt="{{$comment->user->name}}">
              <div class="media-body">
                <h5 class="mt-0">{{$comment->user->name}}
                  <span class="ml-2 time" title="{{ $comment->created_at->toDateTimeString() }}">
                                      {{ $comment->created_at->diffForHumans() }}
                                    </span>
                  <span class="float-right h6 time">#{{$key+1}}</span>
                </h5>
                <p>{{$comment->content}}</p>
                <span>
                                    <a id="like-{{$comment->id}}" href="javascript:themeApp.like({{$comment->id}});"
                                       data-like="5" title="顶一下">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i> 赞(5)
                                    </a>&nbsp;&nbsp;
                                    <a href="javascript:themeApp.reply({{$comment->id}},'{{$comment->user->name}}')">
                                      <i class="fa fa-reply" aria-hidden="true"></i> 回复
                                    </a>
                                    <a href="javascript:themeApp.report({{$comment->id}})" class="float-right">
                                      <i class="fa fa-exclamation-circle" aria-hidden="true"></i> 举报
                                    </a>
                                </span>
              </div>
            </div>
            @empty
            <div class="post-comment text-center">
                <h5 class="p-3">(=￣ω￣=)··· 暂无内容！</h5>
            </div>
          @endforelse
          <div class="post-comment-bar  mt-4" id="reply" name="reply">
            <h4 class="mb-0"><span class="badge badge-primary"><i class="fa fa-reply" aria-hidden="true"></i> 回复</span>
            </h4>
            <div class="clearfix"></div>
          </div>
          <div class="post-reply p-2 mb-5">
            @auth
              <form action="{{route('comments.store')}}" method="post">
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input id="post_id" type="hidden" name="post_id" value="{{ $post->id }}">
                </div>
                <div class="form-group" id="reply">
                  <textarea name="reply_content" id="reply_content" class="form-control" rows="5"
                            placeholder="你要评论的内容..."></textarea>
                </div>
                <div class="form-group m-0">
                  <button type="submit" class="btn btn-default btn-block">提交评论</button>
                </div>
              </form>
            @else
              <div class="d-flex justify-content-center mt-5 mb-5">
                <h5>您还未登录,请先<a href="{{route('login')}}">登录</a>或者<a href="{{route('register')}}">注册</a></h5>
              </div>
            @endauth
          </div>
          <!--end comments -->

        </div>
        <!-- end main post area -->

        <!-- start sidebar -->
      @include('layouts._sidebar')
      <!-- end sidebar -->

      </div>
    </div>
  </section>
  <!-- end site's main /content area -->

  <!-- start main-footer -->
  @include('layouts._footer')
  <!-- end main-footer -->

@endsection

@section('scripts')
  <script type="text/javascript" src="{{ asset('lib/tribute/tribute.min.js') }}"></script>
  <script>
    $(function () {
      var tribute = new Tribute({
        values: [
          {key: 'Phil Heartman', value: 'pheartman'},
          {key: 'Gordon Ramsey', value: 'gramsey'}
        ]
      });
      tribute.attach(document.getElementById('reply_content'));

      $("#delete").click(function () {
        swal({
          title: "确定要删除吗?",
          text: "一旦删除，文章无法恢复!",
          icon: "warning",
          buttons: ["取消操作", "确定删除"],
          dangerMode: true,
        })
          .then((willDelete) => {
            if (willDelete) {
              axios({
                method: 'delete',
                url: '{{ route('post.destroy', $post->hash_id) }}'
              }).then(function (response) {
                swal(response.data.msg, {
                  icon: "success",
                }).then(function () {
                  location = '{{ route('index') }}';
                });
              });
            }
          });
      });
    });
  </script>
@endsection
