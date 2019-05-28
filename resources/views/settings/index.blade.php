@extends('layouts.app')
@section('title', '系统设置')
@section('body')

  <!-- start navigation -->
  @include('layouts._nav')
  <!-- end navigation -->

  <!-- start site's main /content area -->
  <section class="content-wrap">
    <div class="container">
      <div id="profile" class="row">
        <!-- start main area -->
        <div class="col-3">
          <ul class="list-group text-center">
            <li class="list-group-item active">
              <a href="{{ route('setting.index')}}"><i class="fa fa-cog" aria-hidden="true"></i>
                系统设置</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('category.index') }}"><i class="fa fa-folder-open" aria-hidden="true"></i>
                分类管理</a>
            </li>
            <li class="list-group-item">
              <a href="{{ route('link.index') }}"><i class="fa fa-link" aria-hidden="true"></i>
                友链管理</a>
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-cog" aria-hidden="true"></i> 系统设置
            </div>
            <div class="card-body">
              <!-- start message tips -->
            @include('layouts._msg')
            <!-- end message tips -->

              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab"
                     aria-controls="nav-basic" aria-selected="true">基本设置</a>
                  <a class="nav-item nav-link" id="nav-mail-tab" data-toggle="tab" href="#nav-mail" role="tab"
                     aria-controls="nav-mail" aria-selected="false">邮件设置</a>
                  <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#nav-other" role="tab"
                     aria-controls="nav-other" aria-selected="false">其他设置</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
                  <form class="mt-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="nav-mail" role="tabpanel" aria-labelledby="nav-mail-tab">...</div>
                <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">...</div>
              </div>

            </div>
          </div>
        </div>
        <!-- end main area -->
      </div>
    </div>
  </section>
  <!-- end site's main /content area -->

  <!-- start main-footer -->
  @include('layouts._footer')
  <!-- end main-footer -->

@endsection
