<aside class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
  <!-- start widget -->
  <div class="widget">
    <h4 class="title">搜索文章</h4>
    <div class="content">
      <input type="text" class="form-control" id="keyword" placeholder="请输入关键词...">
        <i id="search" class="fa fa-search float-right" aria-hidden="true"></i>
      </input>
    </div>
  </div>
  <!-- end widget -->

  <!-- start Newsletter widget -->
  <div class="widget">
    <h4 class="title">订阅邮件</h4>
    <div class="content newsletter">
      <div class="form-group">
        <div class="input-group">
          <input id="subscribe_email" class="form-control required email" type="email" name="email" required
                 placeholder="请输入您的电子邮件地址..."/>
        </div>
        <div class="input-group">
          <button class="btn btn-default btn-block" type="button" onclick="app.subscribe()">
            <span>订阅</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- end Newsletter widget -->

  <!-- start Recent Post widget -->
  <div class="widget">
    <h4 class="title">最新发布</h4>
    <div class="content recent-post">
      @foreach($recent_posts as $post)
        <div class="recent-single-post">
          <a href="{{route('post.show',$post->slug)}}" class="post-title">{{$post->title}}</a>
          <div class="date">{{$post->created_at->toDateTimeString()}}</div>
        </div>
      @endforeach
    </div>
  </div>
  <!-- end Recent Post widget -->

  <!-- start tag cloud widget -->
  <div class="widget">
    <h4 class="title">标签云</h4>
    <div class="content tag-cloud">
      @foreach($top_tags as $tag)
        <a href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>
      @endforeach
      <a href="{{route('tags')}}">...</a>
    </div>
  </div>
  <!-- end tag cloud widget -->

</aside>
