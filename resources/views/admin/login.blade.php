{{-- @extends('adminlte::register')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Admin login here. !</p>
                </div>
            </div>
        </div>
    </div>
@stop
 --}}

@extends('adminlte::master')
@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', 'login-page')

@php( $login_url = url("/admin/login") )



@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a><b>Admin Login</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ __('adminlte::adminlte.login_message') }}</p>
                <form action="{{ $login_url }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('adminlte::adminlte.password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                {{ __('adminlte::adminlte.sign_in') }}
                            </button>
                        </div>
                    </div>
                </form>
                {{-- <p class="mt-2 mb-1">
                    <a href="{{ $password_reset_url }}">
                        {{ __('adminlte::adminlte.i_forgot_my_password') }}
                    </a>
                </p> --}}
                {{-- @if ($register_url)
                    <p class="mb-0">
                        <a href="{{ $register_url }}">
                            {{ __('adminlte::adminlte.register_a_new_membership') }}
                        </a>
                    </p>
                @endif --}}
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
