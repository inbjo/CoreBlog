@extends('layouts.app')
@section('title', sysConfig('SITE_NAME').' - '.sysConfig('SITE_SLOGAN'))
@section('body')

  <!-- start navigation -->
  @include('layouts._nav')
  <!-- end navigation -->

  <!-- start site's main content area -->
  <section class="content-wrap">
    <div class="container">
      <div class="row">

        <!-- start main post area -->
      @include('layouts._main')
      <!-- end main post area -->

        <!-- start sidebar -->
      @include('layouts._sidebar')
      <!-- end sidebar -->
      </div>
    </div>
  </section>
  <!-- end site's main content area -->

  <!-- start main-footer -->
  @include('layouts._footer')
  <!-- end main-footer -->

@endsection
