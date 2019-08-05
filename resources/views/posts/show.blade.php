@extends('layouts.app')
@section('title', $post->title.' - '.config('system.name'))
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
                      <a href="{{route('post.show',$post->slug)}}#comments">{{$post->comment_count}}条评论</a>
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
                <div data-toggle="tooltip" data-placement="top" title="{{$post->comment_count}}人评论了这篇文章">
                  <i class="fa fa-comments" aria-hidden="true"></i>
                  <span class="badge">{{$post->comment_count}}</span>
                </div>
                <div data-toggle="tooltip" data-placement="top" title="{{$post->favorite_count}}人赞了这篇文章">
                  <i class="fa fa-heart" aria-hidden="true"></i>
                  <span class="badge" id="post-favorite-count">{{$post->favorite_count}}</span>
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
            <div class="col-4">
              <div class="item active" data-money="1"><i class="fa fa-cny"></i> 1</div>
            </div>
            <div class="col-4">
              <div class="item" data-money="5"><i class="fa fa-cny"></i> 5</div>
            </div>
            <div class="col-4">
              <div class="item" data-money="10"><i class="fa fa-cny"></i> 10</div>
            </div>
            <div class="col-4">
              <div class="item" data-money="20"><i class="fa fa-cny"></i> 20</div>
            </div>
            <div class="col-4">
              <div class="item" data-money="50"><i class="fa fa-cny"></i> 50</div>
            </div>
            <div class="col-4">
              <div class="item" data-money="100"><i class="fa fa-cny"></i> 100</div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="money">自定义金额</label>
                <input type="number" class="form-control" id="money" placeholder="请输入你要打赏的金额">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="money">打赏赠言</label>
                <textarea class="form-control" name="remark" id="remark" rows="3" placeholder="对作者说点啥..."></textarea>
              </div>
            </div>
            <div class="col-12">
              <h5>请选择付款方式:</h5>
            </div>
            <div class="col-6">
              <div class="item active" data-type="alipay"><i class="fa fa-cny"></i> 支付宝</div>
            </div>
            <div class="col-6">
              <div class="item" data-type="wechat"><i class="fa fa-cny"></i> 微信</div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btn-reward" type="button" class="btn btn-primary">打赏</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->

  <!-- Wechat Pay Modal -->
  <div class="modal fade" id="wechatPayModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">请使用微信扫描下方二维码完成支付</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 text-center">
              <div id="qrcode"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" type="button" class="btn btn-primary">我已完成支付</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Wechat Pay Modal -->

@endsection
