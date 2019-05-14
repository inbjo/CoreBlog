@extends('layouts.app')
@section('title', __('Sitemap'))
@section('body')


    <!-- start site's main content area -->
    <section class="content-wrap">
        <div class="container">
            <div class="row m-5">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">网站地图</h4>
                        </div>
                        <div class="card-body">

                            @foreach($posts as $post)
                                <div class="article">
                                    <div class="title">
                                        <a href="{{route('user.show',$post->user->username)}}">{{$post->user->nickname}}</a>
                                        于
                                        <time>{{ $post->created_at->toDateTimeString() }}</time>
                                        发表了文章 <a href="{{ route('post.show',$post->hash_id) }}">{{ $post->title }}</a>
                                    </div>
                                    <div class="tags">
                                        标签:
                                        @foreach($post->tags as $tag)
                                            <a href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end site's main content area -->


@endsection
