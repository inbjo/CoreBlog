<footer id="footer-warp">
    <!-- start main-footer -->
    <div id="footer" class="container-fluid">
        <div class="container">
            <div class="row">
                <!-- start first footer widget area -->
                <div class="col-sm">
                    <!-- start widget -->
                    <div class="widget">
                        <h4 class="title">最热文章</h4>
                        <div class="content recent-post">
                            @foreach($hot_posts as $post)
                                <div class="recent-single-post">
                                    <a href="{{route('post.show',$post->slug)}}"
                                       class="post-title">{{$post->title}}</a>
                                    <div class="date">{{$post->created_at->toDateTimeString()}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- end widget -->
                </div>
                <!-- end first footer widget area -->

                <!-- start second footer widget area -->
                <div class="col-sm">
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
                </div>
                <!-- end second footer widget area -->

                <!-- start third footer widget area -->
                <div class="col-sm">
                    <!-- start widget -->
                    <div class="widget">
                        <h4 class="title">友情链接</h4>
                        <div class="content friend-links">
                            @foreach($links as $link)
                                <a href="{{ $link->url }}" target="_blank">{{ $link->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- end widget -->
                </div>
                <!-- end third footer widget area -->
            </div>
        </div>
    </div>
    <!-- start main-footer  -->

    <!-- start copyright section -->
    <div id="copyright" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span>Copyright &copy; <a href="{{ config('app.url') }}">{{ sysConfig('SITE_NAME') }}</a> All right Reserved.
                      Powered By <a href="https://github.com/inbjo/CoreBlog" target="_blank">CoreBlog</a></span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12">
                    <span><a href="{{ route('sitemap') }}" target="_blank">网站地图</a></span>
                    <span></span>
                    <span>
                    <a href="{{ route('feed') }}" target="_blank">RSS</a>
                </span>
                    <span></span>
                    <span>
                    <a href="http://www.beian.miit.gov.cn" target="_blank">{{ sysConfig('SITE_ICP') }}</a>
                </span>
                    <span></span>
                    <span>
                    <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode={{ getPoliceNumber() }}"
                       target="_blank">{{ sysConfig('SITE_POLICE') }}</a>
                </span>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright section -->

    <!-- start back-to-top -->
    <a id="back-to-top" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>
    <!-- end back-to-top -->
</footer>

