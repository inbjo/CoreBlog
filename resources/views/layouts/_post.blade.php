@foreach($posts as $post)
    <article class="post">
        <div class="post-head">
            <h3 class="post-title">
                <a href="{{route('post.show',$post->hash_id)}}">{{$post->title}}</a>
            </h3>
            <div class="post-meta">
                <span class="author">By
                    <a href="{{route('user.show',$post->user->username)}}" title="查看该作者发布的所有文章">{{$post->user->nickname}}</a>
                </span> &bull;
                <span class="date" title="{{ $post->created_at->toDateTimeString() }}">
                    {{$post->created_at->diffForHumans() }}
                </span>&bull;
                <span class="comment-count">
                        <a href="{{route('post.show',$post->hash_id)}}#comments">{{$post->comment_count}}条评论</a>
                </span>
            </div>
        </div>
        @if($post->cover)
        <div class="featured-media">
            <a href="{{route('post.show',$post->id)}}"><img src="{{$post->cover}}" alt="{{$post->title}}"></a>
        </div>
        @endif
        <div class="post-content">
            <p>{{$post->description}}</p>
        </div>
        <div class="post-footer clearfix">
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
        </div>
    </article>
@endforeach
