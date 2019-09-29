@extends('layouts.app')
@section('title', $post->title.' - '.sysConfig('SITE_NAME'))
@section('keyword', $post->keyword)
@section('description', $post->description)

@section('body')

  <!-- start navigation -->
  @include('layouts._nav')
  <!-- end navigation -->

  <!-- start site's main /content area -->
  <div class="container">
    <div class="row justify-content-center login">
      <div class="col-md-8">
        @if(session('error'))
          <div class="alert alert-danger" role="alert">
            {{ session('error')}}
          </div>
        @endif
        <div class="card">
          <div class="card-header">这是一篇私密的文章</div>

          <div class="card-body">
            <form method="POST" action="{{ route('post.unlock',$post->slug) }}">
              @csrf

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">访问密码</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" required>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    解锁
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end site's main /content area -->

  <!-- start main-footer -->
  @include('layouts._footer')
  <!-- end main-footer -->

@endsection
