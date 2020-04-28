@extends('adminlte::master')

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'login-page')



@section('body')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">

                <div class="title m-b-md">
                    <p class="login-box-msg">{{ __('auth.unauthorized_message') }}</p>
                </div>

                <p class="mt-2 mb-1 text-center">
                    <a  href="{!! route('home') !!}">
                        {{ __('auth.unauthorized_home_page') }}
                    </a>
                </p>

            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
