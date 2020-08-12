<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/style.css') }}">

    {{-- Added By Hassan --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">

    {{-- Added By Hassan --}}


    @yield('meta_tags')
    @yield('custom_css')


    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    
    {{-- Added By Hassan --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    {{-- Added By Hassan --}}
    

</head>
<body class="{{$classes_body}}">

{{-- @yield('body') --}}

<div class="main">
 <div class="wrapper">
     @include('site.layout.userheader')

    <div class="content">
    <div class="cont_w">
        <div class="column_main">
        <div class="col_center">
            @yield('content')
        </div>
        @include('site.layout.leftmenu')
        </div>
    </div>
    </div>
</div>
</div>

{{-- ========================================= POPUP For Email========================================== --}}

    <!-- Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true"data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content emailModalContent">
          <div class="modal-header">
            <h5 class="modal-title" id="emailModalHeader"> Confirm Update Email </h5>
         {{--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}
          </div>
          <div class="modal-body">
            <p> After clicking "Confirm" you will be logout !</p>
            <p>To continue your session on "TalentTube" </p>
            <p>You need to Log In again with your new Email Address.</p>
            <p class="textNewEmailAddress">Your new Email Address will be:</p><p class="updatedEmailInModal"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="c-update-email" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- ========================================= POPUP For Email Ending ========================================== --}}

{{-- ========================================= POPUP For Email========================================== --}}

    <!-- Modal -->
    <div class="modal fade" id="PhoneModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true"data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content PhoneModalContent">
          <div class="modal-header">
            <h5 class="modal-title" id="emailModalHeader">Confirm Update Phone</h5>
         {{--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}
          </div>
          <div class="modal-body">
            <p> After clicking "Confirm" your phone number will be updated !</p>
            {{-- <p>To continue your session on "TalentTube" </p> --}}
            {{-- <p>You need to Log In again with your new Email Address.</p> --}}
            <p class="textNewEmailAddress">Your new Phone Number will be:</p><p class="updatedPhoneInModal"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="update-Phone" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- ========================================= POPUP For Email Ending ========================================== --}}

{{-- ========================================= POPUP For Password ========================================== --}}

   <!-- Modal -->
    <div class="modal fade" id="PasswordModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true"data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content emailModalContent">
          <div class="modal-header">
            <h5 class="modal-title" id="emailModalHeader"> Confirm Update Password </h5>
         {{--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}
          </div>
          <div class="modal-body">
            <p> After clicking "Confirm" you will be logout !</p>
            <p>To continue your session on "TalentTube" </p>
            <p>You need to Log In again with your new Email Address.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="update-password" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- ========================================= POPUP For Password Ending ========================================== --}}




 {{-- @include('site.user.footer') --}} PasswordUpdateBUtton

<script src="{{asset('/js/lang.js')}}"></script>

<script src="{{ asset('js/site/modernizr.js') }}"></script>
<script src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script src="{{ asset('js/site/impact_lib.js') }}"></script>
<script src="{{ asset('js/site/lib.js') }}"></script>
<script src="{{ asset('js/site/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.formstyler.js') }}"></script>


{{-- <script src="{{ asset('js/site/profile.js') }}"></script>  --}}

<script src="{{ asset('js/site/userProfile.js') }}"></script>

@yield('custom_footer_css')
<style type="text/css">
    h5#emailModalHeader {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    color: #254c8e;
}
.textNewEmailAddress{
    float: left;
    margin: 0px 5px 0px 0px;
}
.updatedEmailInModal {
    color: #254c8e;
    font-weight: 700;
    /*font-size: 16px;*/
}
.modal-content.emailModalContent,.modal-content.PhoneModalContent {
    width: 80%;
}
div.modal-content.emailModalContent>.modal-body {
    margin: 0px auto;
    width: 80%;

}
div.modal-content.PhoneModalContent>.modal-body {
    margin: 0px auto;
    width: 85%;

}
div.modal-content.emailModalContent>div.modal-body>p,div.modal-content.PhoneModalContent>div.modal-body>p {
    margin: 0px 0px 0px 0px;
    line-height: 15px;
}

</style>
@yield('custom_js')

</body>
</html>
