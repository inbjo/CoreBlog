@extends('layouts.app')
@section('title', $post->title.' - '.sysConfig('SITE_NAME'))
@section('keyword', $post->keyword)
@section('description', $post->description)

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
          <article id="post-wrap" class="post page" data-id="{{ $post->id }}">
            <div class="post-head">
              <h3 class="post-title">{{$post->title}}</h3>
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
                      <a href="#comments">{{$post->comments->count()}}条评论</a>
                  </span>
              </div>
            </div>
            @if($post->status !=1)
              <div class="alert alert-warning mt-2" role="alert">
                当前文章为草稿状态，仅您可见！
              </div>
            @endif
            @if($post->cover)
              <div class="featured-media">
                <img src="{{$post->cover}}" alt="{{$post->title}}">
              </div>
            @endif
            <div class="post-content">
              {!! $post->content !!}
            </div>
            <div class="post-action">
              <button id="likePost" data-id="{{ $post->id }}"
                      class="btn btn-circle {{$post->isFavorited() ? 'active' : '' }}"
                      data-toggle="tooltip" data-placement="bottom" title="点赞这篇文章">
                <i class="fa fa-thumbs-up"></i>
              </button>
              <button id="rewardAuthor" class="btn btn-circle active" data-toggle="tooltip"
                      data-placement="bottom" title="打赏这篇文章的作者">
                <i class="fa fa-cny"></i>
              </button>
            </div>
            @can('update', $post)
              <div class="post-operate clearfix">
                <button id="delete" data-id="{{ $post->id }}" class="btn btn-danger btn-sm float-right">删除</button>
                <a href="{{ route('post.edit',$post->slug) }}"
                   class="btn btn-primary btn-sm float-right mr-2">编辑</a>
              </div>
            @endcan
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
                <div data-toggle="tooltip" data-placement="top" title="{{$post->comments->count()}}人评论了这篇文章">
                  <i class="fa fa-comments" aria-hidden="true"></i>
                  <span class="badge">{{$post->comments->count()}}</span>
                </div>
                <div data-toggle="tooltip" data-placement="top" title="{{$post->favorites_count}}人赞了这篇文章">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                  <span class="badge" id="post-favorite-count">{{$post->favorites_count}}</span>
                </div>
              </div>
            </div>
          </article>
          <!-- end post -->

          <!--start comments -->
        @include('layouts._comment')
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

  <!-- Modal -->
  <div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">打赏作者</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 text-center">
              <div id="paycode" data-switch="{{$post->user->extend->reward ?? 'false'}}"></div>
            </div>
          </div>
          <hr/>
          <div id="pay-wrap" class="row">
            @if($post->user->extend->alipay_paycode ?? false)
              <div class="col">
                <div class="item" data-url="{{$post->user->extend->alipay_paycode}}"><i class="fa fa-cny"></i>
                  支付宝
                </div>
              </div>
            @endif
            @if($post->user->extend->wechat_paycode ?? false)
              <div class="col">
                <div class="item" data-url="{{$post->user->extend->wechat_paycode}}"><i class="fa fa-weixin"></i> 微信</div>
              </div>
            @endif
            @if($post->user->extend->qq_paycode ?? false)
              <div class="col">
                <div class="item" data-url="{{$post->user->extend->qq_paycode}}"><i class="fa fa-qq"></i> QQ</div>
              </div>
            @endif
          </div>
        </div>
      </div>
  </div>
  </div>
  <!-- Modal -->

  <!-- Modal -->
  <div class="modal fade" id="wechatModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">请使用微信扫一扫加好友</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 text-center">
              <div id="wechat_qrcode"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->

@endsection
