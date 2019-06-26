<div class="post-comment-bar" id="comments">
  <h4 class="mb-0">
                <span class="badge badge-primary">
                   <i class="fa fa-comments" aria-hidden="true"></i> 评论
                </span>
  </h4>
  <div class="clearfix"></div>
</div>
@forelse ($comments as $key=> $comment)
  <div class="post-comment media" id="comment{{$comment->id}}" name="comment{{$comment->id}}">
    <img class="mr-3 avatar rounded-circle" src="{{$comment->user->avatar}}"
         alt="{{$comment->user->name}}">
    <div class="media-body">
      <h5 class="mt-0">
        <a class="user-link" href="{{ route('user.show',$comment->user->name) }}"
           target="_blank" data-toggle="tooltip" data-placement="bottom"
           title="查看{{$comment->user->name}}发表的文章">{{$comment->user->name}}</a>
        <span class="ml-2 time" title="{{ $comment->created_at->toDateTimeString() }}">
                       {{ $comment->created_at->diffForHumans() }}
                  </span>
        <span class="float-right h6 time">#{{$key+1}}</span>
      </h5>
      <p>{!! $comment->content !!}</p>
      <span>
                    <div class="float-left favorite" data-id="{{$comment->id}}" data-toggle="tooltip"
                         data-placement="bottom" title="点赞这条评论">
                         <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                      赞(<span class="num">{{ $comment->favorite_count }}</span>)
                    </div>
                    <div class="float-left reply" data-name="{{$comment->user->name}}" data-toggle="tooltip"
                         data-placement="bottom" title="回复{{$comment->user->name}}">
                         <i class="fa fa-reply" aria-hidden="true"></i> 回复
                    </div>
                    @can('delete',$comment)
          <div class="float-right delete" data-id="{{$comment->id}}" data-toggle="tooltip"
               data-placement="bottom" title="删除该评论">
                         <i class="fa fa-trash-alt" aria-hidden="true"></i> 删除
                    </div>
        @endcan
                </span>
    </div>
  </div>
@empty
  <div class="post-comment text-center">
    <h5 class="p-3">(=￣ω￣=)··· 暂无内容！</h5>
  </div>
@endforelse
<div class="post-comment-bar mt-4" id="reply">
  <h4 class="mb-0">
              <span class="badge badge-primary">
                   <i class="fa fa-reply" aria-hidden="true"></i> 回复
              </span>
  </h4>
  <div class="clearfix"></div>
</div>
<div class="post-reply p-2 mb-5">
  @auth
    <form action="{{route('comment.store')}}" method="post">
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
      <h5>您还未登录,请先<a href="{{route('login')}}">登录</a>或者<a href="{{route('register')}}">注册</a>
      </h5>
    </div>
  @endauth
</div>
