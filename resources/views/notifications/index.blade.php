@extends('layouts.app')

@section('title', '我的通知 - '.config('system.name'))

@section('body')
    <!-- start navigation -->
    @include('layouts._nav')
    <!-- end navigation -->

    <div class="container content-wrap">
        <div class="col-12">
            <div class="card mb-5">

                <div class="card-body">

                    <h3 class="text-xs-center">
                        <i class="far fa-bell" aria-hidden="true"></i> 我的通知
                    </h3>
                    <hr>

                    @if ($notifications->count())

                        <div class="list-unstyled notification-list">
                            @foreach ($notifications as $notification)
                                @include('notifications.types._' . snake_case(class_basename($notification->type)))
                            @endforeach

                            {!! $notifications->render() !!}
                        </div>

                    @else
                        <div class="empty-block">没有消息通知！</div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- start main-footer -->
    @include('layouts._footer')
    <!-- end main-footer -->
@stop
