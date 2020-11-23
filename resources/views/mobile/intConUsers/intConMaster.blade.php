<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>
    @yield('meta_tags')
    <script type="text/javascript">
        var base_url = '{!! url('/') !!}';
    </script>

      <!-- MDB icon -->
      <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="{{ asset('css/mobile/mdb/bootstrap.min.css') }}">
      <!-- Material Design Bootstrap -->
      <link rel="stylesheet" href="{{ asset('css/mobile/mdb/mdb.min.css') }}">
      <!-- Your custom styles (optional) -->
      <link rel="stylesheet" href="{{ asset('css/mobile/style.css') }}">

      @yield('custom_css')

</head>
<body class="hidden-sn grey-skin @yield('classes_body')" @yield('body_data')  >

 {{-- @include('mobile.header.header') --}}
 {{-- @include('mobile.modals.jobsModal') --}}

  <!--Main Layout-->
  <main class="p-0">
    <div class="homeBg">
      <div class="container-fluid">
       @yield('content')
      </div>
  </main>
  <!--Main Layout-->






{{-- <style type="text/css">
    /* Only for snippet */
.double-nav .breadcrumb-dn {
  color: #fff;
}
</style> --}}

@yield('custom_footer_css')
<style type="text/css">
.homeBg {
    background-image: url('../../images/mobile/homepage_bg.jpg');
    background-size: cover;
    position: absolute;
    width: 100%;
    height: auto;
    /*height: 100%;*/
}

main .container-fluid {
    background: none ;
}


</style>

<!-- jQuery -->
<script type="text/javascript" src="{{ asset('js/mobile/mdb/jquery.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('js/mobile/mdb/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('js/mobile/mdb/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('js/mobile/mdb/mdb.min.js') }}"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript" src="{{ asset('js/mobile/script.js') }}"></script>



@yield('custom_js')

{{-- <script type="text/javascript">
    $(document).ready(function() {
        // SideNav Initialization
        $(".button-collapse").sideNav();
    });
</script> --}}

</body>
</html>
