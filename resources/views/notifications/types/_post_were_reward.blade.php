<li class="media pb-3">
    <div class="media-left">
        <a href="{{ route('user.show', $notification->data['user_name']) }}">
            <img class="media-object img-fluid rounded-circle mr-3 mt-2" alt="{{ $notification->data['user_name'] }}"
                 src="{{ $notification->data['user_avatar'] }}" style="width:48px;height:48px;"/>
        </a>
    </div>

    <div class="media-body">
        <div class="media-heading mt-1 mb-1 text-secondary">
            <a href="{{ route('user.show', $notification->data['user_name']) }}">{{ $notification->data['user_name'] }}</a>
            打赏了您的文章
            <a href="{{ $notification->data['link'] }}" target="_blank">{{ $notification->data['post_title'] }}</a>
            ￥{{$notification->data['amount']}}

            <span class="meta float-right" title="{{ $notification->created_at }}">
        <i class="far fa-clock"></i>
        {{ $notification->created_at->diffForHumans() }}
      </span>
        </div>
        <div class="reply-content">
            并留言:{{$notification->data['remark']}}
        </div>
    </div>
</li>
