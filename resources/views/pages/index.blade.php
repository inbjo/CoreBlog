@extends('layouts.app')
@section('title', '首页')
@section('body')

  <!-- start navigation -->
  @include('blog._nav')
  <!-- end navigation -->

  <!-- start site's main content area -->
  <section class="content-wrap">
    <div class="container">
      <div class="row">

        <!-- start main post area -->
      @include('blog._main')
      <!-- end main post area -->

        <!-- start sidebar -->
      @include('blog._sidebar')
      <!-- end sidebar -->
      </div>
    </div>
  </section>
  <!-- end site's main content area -->

  <!-- start main-footer -->
  @include('blog._footer')
  <!-- end main-footer -->

  <!-- start copyright section -->
  @include('blog._copyright')
  <!-- end copyright section -->
@endsection
