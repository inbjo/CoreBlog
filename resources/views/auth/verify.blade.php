@extends('layouts.app')
@section('title', __('Verify Your Email Address').' - '.config('system.name'))
@section('body')

    <!-- start navigation -->
    @include('layouts._nav')
    <!-- end navigation -->

    <!-- start site's main /content area -->
    <div class="container">
        <div class="row justify-content-center verify">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email,') }}
                        <a href="{{ route('verification.resend') }}">
                            {{ __('click here to request another') }}
                        </a>
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
