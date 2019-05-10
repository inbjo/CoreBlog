<footer class="main-footer">
    <div class="container">
        <div class="row">
            <!-- start first footer widget area -->
            <div class="col-sm-4">
                <!-- start widget -->
                <div class="widget">
                    <h4 class="title">最新发布</h4>
                    <div class="content recent-post">
                        @foreach($top_posts as $post)
                            <div class="recent-single-post">
                                <a href="{{route('post.show',$post->id)}}" class="post-title">{{$post->title}}</a>
                                <div class="date">{{$post->created_at->toDateTimeString()}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- end widget -->
            </div>
            <!-- end first footer widget area -->

            <!-- start second footer widget area -->
            <div class="col-sm-4">
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
            <div class="col-sm-4">
                <!-- start widget -->
                <div class="widget">
                    <h4 class="title">友情链接</h4>
                    <div class="content friend-links">
                        <a href="#" title="阿里云" target="_blank">阿里云</a>
                        <a href="#" title="又拍云" target="_blank">腾讯云</a>
                        <a href="#" title="Ucloud" target="_blank">Ucloud</a>
                    </div>
                </div>
                <!-- end widget -->
            </div>
            <!-- end third footer widget area -->
        </div>
    </div>
</footer>
