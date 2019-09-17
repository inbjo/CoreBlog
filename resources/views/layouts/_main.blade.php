<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 main-content">
    <!-- start message tips -->
    @include('layouts._msg')
    <!-- end message tips -->

    <div id="pwaTip" class="alert alert-light d-none" role="alert">
      温馨提醒:本站支持PWA，点击我可安装到桌面。
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- start post -->
    @include('layouts._post')
    <!-- end post -->

    <!-- start pagination -->
    @include('layouts._paginate')
    <!-- end pagination -->

</div>
