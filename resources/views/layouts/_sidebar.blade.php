<aside class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 sidebar">
  <!-- start widget -->
  <div class="widget">
    <h4 class="title">关注我们</h4>
    <div class="content">
      <ul class="social">
        <!-- start social links -->
        <!-- replace the # with your own profile link address -->
        <li><a href="index.html#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-google-plus"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-linkedin"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-skype"></i></a></li>
        <li><a href="index.html#"><i class="fa  fa-pinterest"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-youtube"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-vimeo-square"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-dribbble"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-flickr"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-tumblr"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-github"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-instagram"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-stack-overflow"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-stack-exchange"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-xing"></i></a></li>
        <li><a href="index.html#"><i class="fa fa-envelope"></i></a></li>
        <li><a href="rss/index.html"><i class="fa fa-rss"></i></a></li>
        <!-- end social links -->
      </ul>
    </div>
  </div>
  <!-- end widget -->

  <!-- start Newsletter widget -->
  <div class="widget">
    <h4 class="title">订阅邮件</h4>
    <div class="content newsletter">
      <div class="form-group">
        <div class="input-group">
          <input id="subscribe_email" class="form-control required email" type="email" name="email" required placeholder="请输入您的电子邮件地址..."/>
        </div>
        <div class="input-group">
          <button class="btn btn-default btn-block" type="button" onclick="themeApp.subscribe()">
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
      @foreach($top_posts as $post)
        <div class="recent-single-post">
          <a href="{{route('post.show',$post->hash_id)}}" class="post-title">{{$post->title}}</a>
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
