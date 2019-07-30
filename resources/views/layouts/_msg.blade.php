@if ($errors->any())
  <div class="alert alert-danger" role="alert">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
    <div class="flash-message">
      <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
        {{ session()->get($msg) }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  @endif
@endforeach

<div id="pwaTip" class="alert alert-light d-none" role="alert">
  温馨提醒:本站支持PWA，点击我可安装到桌面。
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
