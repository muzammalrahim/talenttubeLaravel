@extends('site.master')

@section('title', $title)

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('custom_css')
<link rel="stylesheet" href="{{ asset('assests/custom-css/Style.css') }}">

    <link rel="stylesheet" href="{{ asset('assests/custom-css/MyStyle.css') }}"> 
@endsection

@section('classes_body', 'homepage')

@section('body')


@stop


@section('custom_js')
<script type="text/javascript" src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/login_form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.form.js') }}"></script>

    

{{-- <script type="text/javascript" src="{{ asset('js/site/lib.js') }}"></script> --}}

<script src="{{ asset('assests/bootstrap/js/jquery.js') }}"></script>
<script src="{{ asset('assests/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assests/bootstrap/js/bootstrap.min.js')}}"></script>

@stop