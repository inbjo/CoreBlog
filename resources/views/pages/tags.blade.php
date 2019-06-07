@extends('layouts.app')
@section('title','标签云 - '.config('system.name'))
@section('body')

    <!-- start navigation -->
    @include('layouts._nav')
    <!-- end navigation -->

    <!-- start site's main /content area -->
    <section class="content-wrap">
        <div class="container">
            <div class="row">
                <!-- start main post area -->
                <div class="col-md-8 main-content">
                    <article class="post page">
                        <header class="post-head">
                            <h1 class="post-title">标签云</h1>
                        </header>
                        <section class="post-content widget">
                            <div class="tag-cloud">
                                @foreach($tags as $tag)
                                    <a href="{{route('tag.show',$tag->name)}}">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </section>
                    </article>
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

@endsection
