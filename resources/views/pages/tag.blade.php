@extends('layouts.app')
@section('title', $tag->name.' - 标签')
@section('body')

    <!-- start navigation -->
    @include('blog._nav')
    <!-- end navigation -->

    <!-- start site's main /content area -->
    <section class="content-wrap">
        <div class="container">
            <div class="row">
                <!-- start main post area -->
                <div class="col-md-8 main-content">
                    <div class="cover tag-cover">
                        <h3 class="tag-name">
                            标签: {{$tag->name}}
                        </h3>
                        <div class="post-count">
                            共 {{$tag->posts->count()}} 篇文章
                        </div>
                    </div>

                    <!-- start post -->
                @include('blog._post')
                <!-- end post -->

                    <!-- start pagination -->
                @include('blog._paginate')
                <!-- end pagination -->

                </div>
                <!-- end main post area -->

                <!-- start sidebar -->
            @include('blog._sidebar')
            <!-- end sidebar -->

            </div>
        </div>
    </section>
    <!-- end site's main /content area -->

    <!-- start main-footer -->
    @include('blog._footer')
    <!-- end main-footer -->

@endsection
