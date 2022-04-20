
@extends('site.master')

{{-- @section('title', $title) --}}

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('custom_css')
  <link rel="stylesheet" href="{{ asset('assests/custom-css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('assests/custom-css/homestyle.css') }}">
@stop
@section('classes_body', 'homepage')

@section('body')





@include('site.header.header') {{-- site/header/header --}}
<style>
/*---------------------------------------------------------------------- /
SECTIONS
----------------------------------------------------------------------- */
.section-cards {
    z-index: 3;
    position: relative;
}
/*---------------------------------------------------------------------- /
CARDS
----------------------------------------------------------------------- */
.card {
    display: inline-block;
    position: relative;
    width: 100%;
    margin-bottom: 30px;
    border-radius: 6px;
    color: rgba(0, 0, 0, 0.87);
    background: #fff;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
.card .card-image {
    height: 60%;
    position: relative;
    overflow: hidden;
    margin-left: 15px;
    margin-right: 15px;
    margin-top: -30px;
    border-radius: 6px;
    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
.card .card-image img {
    width: 100%;
    height: 100%;
    border-radius: 6px;
    pointer-events: none;
}
.card .card-image .card-caption {
    position: absolute;
    bottom: 15px;
    left: 15px;
    color: #fff;
    font-size: 1.3em;
    text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
}
.card img {
    width: 100%;
    height: auto;
}
.img-raised {
    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
.card .ftr {
    margin-top: 15px;
}
.card .ftr div {
    display: inline-block;
}
/* ============ Card Blog ============ */
.card-blog {
    margin-top: 30px;
}
.card-blog .card-caption {
    margin-top: 5px;
}
.card-blog .card-image + .category {
    margin-top: 20px;
}
.card-raised {
    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
/* ============ Card Background ============ */
.card-background {
    background-position: center;
    background-size: cover;
    text-align: center;
}
.card-background .table {
    position: relative;
    z-index: 2;
    min-height: 280px;
    padding-top: 40px;
    padding-bottom: 40px;
    max-width: 440px;
    margin: 0 auto;
}
.card-background .category,
.card-background .card-description,
.card-background small {
    color: rgba(255, 255, 255, 0.8);
}
.card-background .card-caption {
    color: #FFFFFF;
    margin-top: 10px;
}
.card-background:after {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    background-color: rgba(0, 0, 0, 0.56);
    border-radius: 6px;
}
/* ============ Card Product ============ */
.card-product .card-caption,
.card-product .category,
.card-product .card-description {
    text-align: center;
}
.card-description p {
    color: #888;
}
.card-description a {
    color: #888;
}
.card-caption,
.card-caption a {
    color: #333;
    text-decoration: none;
}
.card-caption {
    font-weight: 700;
    font-family: "Roboto Slab", "Times New Roman", serif;
}
/* ============ Text Color ============ */
.text-info {
    color: #00bcd4;
}
/* ======= GENERAL  ======= */
body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4 {
    font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    font-weight: 300;
    line-height: 1.5em;
}
a {
    color: #9c27b0;
    text-decoration: none;
}
a:hover {
    color: #9c27b0;
    text-decoration: underline;
}
header {
    border-bottom: 1px solid #dedede;
    text-align: center;
}
    </style>
  </head>
  <body>
  	<!-- ================== banner-section start -->



<!-- ===========================banner-section-end================== -->
    <div class="cards-1 section-gray h-100">
        <div class="container">
            <div class="row">
                <div class="col-12"><h1 class="text-center py-5">All Blog posts will be show here.</h1></div>
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-image">
                            <a href="#"> <img class="img" src="http://adamthemes.com/demo/code/cards/images/blog01.jpeg">
                                <div class="card-caption"> Blog Post Title </div>
                            </a>
                            <div class="ripple-cont"></div>
                        </div>
                        <div class="table px-2">
                            <h6 class="category text-info">Cinema</h6>
                            <p class="card-description"> Lorem ipsum dolor sit amet, consectetur adipis cingelit. Etiam lacinia elit et placerat finibus. Praesent justo metus, pharetra vel nibh sit amet, tincidunt posuere nulla. Vivamus odio antement, feugiat eget nisi sit amet, scelerisque dignissim velit antement. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-image">
                            <a href="#"> <img class="img" src="http://adamthemes.com/demo/code/cards/images/blog01.jpeg">
                                <div class="card-caption"> Blog Post Title </div>
                            </a>
                            <div class="ripple-cont"></div>
                        </div>
                        <div class="table px-2">
                            <h6 class="category text-info">Cinema</h6>
                            <p class="card-description"> Lorem ipsum dolor sit amet, consectetur adipis cingelit. Etiam lacinia elit et placerat finibus. Praesent justo metus, pharetra vel nibh sit amet, tincidunt posuere nulla. Vivamus odio antement, feugiat eget nisi sit amet, scelerisque dignissim velit antement. </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-blog">
                        <div class="card-image">
                            <a href="#"> <img class="img" src="http://adamthemes.com/demo/code/cards/images/blog01.jpeg">
                                <div class="card-caption"> Blog Post Title </div>
                            </a>
                            <div class="ripple-cont"></div>
                        </div>
                        <div class="table px-2">
                            <h6 class="category text-info">Cinema</h6>
                            <p class="card-description"> Lorem ipsum dolor sit amet, consectetur adipis cingelit. Etiam lacinia elit et placerat finibus. Praesent justo metus, pharetra vel nibh sit amet, tincidunt posuere nulla. Vivamus odio antement, feugiat eget nisi sit amet, scelerisque dignissim velit antement. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer><div class="container-fluid bg-light">
    <div class="container">
      <div class="row  d-flex justify-content-center align-items-center">
        <div class="col-md-10 ">
         <div class="footer-nav ">
           <a href=""  class="d-block d-sm-none footer-logo-2"><img src="assests/images/frame1.png" alt=""></a>
           <ul class=" ">
             <li class=""><a href="{{ route('homepage') }}">Home</a></li>
             <li ><a href="{{ route('about-us') }}" >About</a></li>
             <li class="d-none d-sm-block" ><a href="{{ route('homepage') }}" ><img src="assests/images/frame1.png"  alt=""></a></li>
             <li ><a href="{{ route('contact-us') }}" >Contact</a></li>
             <li ><a href="{{ route('blogs') }}" >Blog</a></li>
           </ul>
         </div>
        </div>
        <div class="col-md-10 footer-icon ">
          <ul>
            {{-- <li><a href="#"  ><i class="fab fa-instagram" ></i></a></li> --}}
            {{-- <li> <a href="#" ><i class="fab fa-twitter" ></i></a> </li> --}}
            <li><a href="#" ><i class="fab fa-youtube" ></i></a> </li>
            <li><a href="#" ><i class="fab fa-facebook"></i></a></li>
            <li><a href="#" ><i class="fab fa-linkedin"></i></a></li>
             {{-- <li> <a href="#" ><i class="fab fa-pinterest"></i></a></li> --}}
          </ul>
      </div>
      <div class="col-md-12 CopyRight"><p>CopyRight 2021</p></div>
      </div>
    </div>
  </div>
</footer>  

{{-- <div class="main  "> --}}
   <!-- wrapper -->


<div class="wrappeasasar">

   {{-- @include('site.header') --}}
   {{-- @include('site.header.header') --}}


   {{-- 03-09-2021 --}}


</div>

   <!-- /wrapper -->


{{-- @include('site.home.login') --}}

{{-- @include('site.home.interviewLogin') --}}

{{-- @include('site.footer') --}}



{{-- </div> --}}

@include('web.home.interviewConcierge.signin')


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

@section('custom_footer_css')

<style type="text/css">
  
</style>

@stop
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
