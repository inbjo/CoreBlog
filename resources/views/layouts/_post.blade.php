@foreach($posts as $post)
  <article class="post">
    <div class="post-head">
      <h3 class="post-title">
        <a href="{{route('post.show',$post->slug)}}">{{$post->title}}</a>
      </h3>
      <div class="post-meta">
          <span class="author">By
             <a href="{{route('user.show',$post->user->name)}}" data-toggle="tooltip" data-placement="bottom"
                title="查看{{$post->user->name}}发布的所有文章">{{$post->user->name}}
             </a>
          </span> &bull;
        <span class="date" data-toggle="tooltip" data-placement="bottom"
              title="{{ $post->created_at->toDateTimeString() }}">
            {{$post->created_at->diffForHumans() }}
          </span>&bull;
        <span class="comment-count" data-toggle="tooltip" data-placement="bottom" title="查看该文章的评论">
              <a href="{{route('post.show',$post->slug)}}#comments">{{$post->comment_count}}条评论</a>
          </span>
      </div>
    </div>
    @if($post->cover)
      <div class="featured-media">
        <a href="{{route('post.show',$post->slug)}}"><img src="{{$post->cover}}" alt="{{$post->title}}"></a>
      </div>
    @endif
    <div class="post-content">
      <p>{{$post->description}}</p>
    </div>
    <div class="post-footer">
      <div class="tag-list">
        <i class="fa fa-tag"></i>
        @foreach($post->tags as $tag)
          @if ($loop->last)
            <a href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>
          @else
            <a href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>,
          @endif
        @endforeach
      </div>
      <div class="statistical">
        <div data-toggle="tooltip" data-placement="top" title="这篇文章被查看了{{$post->visits()->count()}}次">
          <i class="fa fa-eye" aria-hidden="true"></i>
          <span class="badge">{{$post->visits()->count()}}</span>
        </div>
        <div data-toggle="tooltip" data-placement="top" title="{{$post->comment_count}}人评论了这篇文章">
          <i class="fa fa-comments" aria-hidden="true"></i>
          <span class="badge">{{$post->comment_count}}</span>
        </div>
        <div data-toggle="tooltip" data-placement="top" title="{{$post->favorite_count}}人赞了这篇文章">
          <i class="fa fa-heart" aria-hidden="true"></i>
          <span class="badge">{{$post->favorite_count}}</span>
        </div>
      </div>
    </div>
  </article>
@endforeach
