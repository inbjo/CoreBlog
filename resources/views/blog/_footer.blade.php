<footer>
    <!-- start main-footer -->
    <div id="footer" class="container-fluid">
        <div class="container">
            <div class="row">
                <!-- start first footer widget area -->
                <div class="col-sm">
                    <!-- start widget -->
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
                            <a href="#" title="CoreBBS" target="_blank">CoreBBS</a>
                            <a href="#" title="CoreShop" target="_blank">CoreShop</a>
                            <a href="#" title="MicroBlog" target="_blank">MicroBlog</a>
                            <a href="#" title="Mix" target="_blank">Mix</a>
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
                    <span>Copyright &copy; 2015-2019 <a
                                href="https://www.inbjo.com">CoreBlog</a> All right Reserved.</span>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12">
                    <span><a href="sitemap.xml" target="_blank">网站地图</a></span>
                    <span></span>
                    <span>
                    <a href="rss.xml" target="_blank">RSS</a>
                </span>
                    <span></span>
                    <span>
                    <a href="http://www.miibeian.gov.cn/" target="_blank">湘ICP备13005379号</a>
                </span>
                    <span></span>
                    <span>
                    <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=43011102001213"
                       target="_blank">湘公网安备43011102001213号</a>
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

