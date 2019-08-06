<div class="post-author media mb-4">
  <img class="mr-3 avatar rounded-circle" src="{{$post->user->avatar}}" alt="{{$post->user->name}}">
  <div class="media-body">
    <h5 class="mt-0">
      <a class="user-link mr-2" href="{{route('user.show',$post->user->name)}}" target="_blank" data-toggle="tooltip"
         data-placement="bottom" title="" data-original-title="查看{{$post->user->name}}发表的文章">{{$post->user->name}}</a>
      @if(!empty($post->user->extend->qq))
      <a href="tencent://message/?uin={{$post->user->extend->qq}}" class="trd"><i class="fa fa-qq"></i></a>
      @endif
      @if(!empty($post->user->extend->wechat))
      <a onclick="swal('微信号是{{$post->user->extend->wechat}}');" class="trd"><i class="fa fa-weixin"></i></a>
      @endif
      @if(!empty($post->user->extend->github))
      <a href="{{$post->user->extend->weibo}}" class="trd"><i class="fa fa-weibo"></i></a>
      @endif
      @if(!empty($post->user->extend->github))
        <a href="{{$post->user->extend->github}}" class="trd"><i class="fa fa-github"></i></a>
      @endif
    </h5>
    <p>{{$post->user->bio}}</p>
  </div>
</div>
<div class="post-comment-bar" id="comments">
  <h4 class="mb-0">
                <span class="badge badge-primary">
                   <i class="fa fa-comments" aria-hidden="true"></i> 评论
                </span>
  </h4>
  <div class="clearfix"></div>
</div>
@forelse ($post->comments as $key=> $comment)
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
<div class="post-comment-bar mt-4" id="reply-wrap">
  <h4 class="mb-0">
              <span class="badge badge-primary">
                   <i class="fa fa-reply" aria-hidden="true"></i> 回复
              </span>
  </h4>
  <div class="clearfix"></div>
</div>
<div class="post-reply p-2 mb-5">
  @auth
    <form id="comment-form" action="{{route('comment.store')}}" method="post">
      <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input id="post_id" type="hidden" name="post_id" value="{{ $post->id }}">
      </div>
      <div class="form-group" id="reply">
                  <textarea name="reply_content" id="reply_content" class="form-control" rows="5"
                            placeholder="请输入您要评论的内容..." required></textarea>
      </div>
      <div class="form-group">
        <input id="verify_token" type="hidden" name="token" />
        <div id="vaptchaContainer" data-id="{{config('system.vaptcha_vid')}}">
          验证码加载中...
        </div>
      </div>
      <div class="form-group m-0">
        <button id="submit-comment" type="button" class="btn btn-default btn-block">提交评论</button>
      </div>
    </form>
  @else
    <div class="d-flex justify-content-center mt-5 mb-5">
      <h5>您还未登录,请先<a href="{{route('login')}}">登录</a>或者<a href="{{route('register')}}">注册</a>
      </h5>
    </div>
  @endauth
</div>
