@extends('layouts.app')
@section('title', $keyword.' - 搜索 - '.config('system.name'))
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
          <div class="cover tag-cover">
            <h3 class="tag-name">
              搜索: {{$keyword}}
            </h3>
            <div class="post-count">
              共找到 {{$posts->total()}} 篇文章
            </div>
          </div>

          <!-- start post -->
        @include('layouts._post')
        <!-- end post -->

          <!-- start pagination -->
        @include('layouts._paginate')
        <!-- end pagination -->

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
