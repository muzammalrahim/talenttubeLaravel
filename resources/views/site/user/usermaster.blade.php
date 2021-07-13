<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">


    <!-- Favicons-->
    <link rel="icon" href="https://talenttube.tv/wp-content/themes/talenttube/favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" href="http://creativedev22.xyz/images/site/logo_inner.png">
    <link rel="icon" href="https://talenttube.org/images/site/logo_inner.png" sizes="32x32">
    <link rel="icon" type="image/png" sizes="16x16" href="https://talenttube.org/images/site/logo_inner.png">
    <link rel="shortcut icon" href="https://talenttube.org/images/site/logo_inner.png" />

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" type="text/css" href="{{asset('css/site/jquery.formstyler.css')}}"/>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/style.css') }}">

    {{-- added on 14-09-2020 --}}
{{--     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
    {{-- added on 14-09-2020 --}}
    
    {{-- Added By Hassan --}}
    <link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
    {{-- Added By Hassan --}}

    @yield('meta_tags')
    @yield('custom_css')

    <script type="text/javascript"> var base_url = '{!! url('/') !!}';</script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


</head>
<body class="{{$classes_body}}">
{{-- @yield('body') --}}
<div class="main">
  @php                     
     // $session1 = Session::get('adminControls');
     $sessionObj = new Symfony\Component\HttpFoundation\Session\Session();
     $session1 = $sessionObj->get('adminControls');
  @endphp 

 <div class="wrapper">
     @if ($controlsession->count() > 0)
      <div class="adminControl">
              <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
      </div>
      @endif
      
     @include('site.layout.userheader')
    <div class="content">
    <div class="cont_w">
        <div class="column_main">
        <div class="col_center">
            @yield('content')
        </div>
        @include('site.layout.leftmenu') {{-- site/layout/leftmenu --}}
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
          <div class="modal-footer d-inline-block">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="c-update-email" type="button" class="btn btn-primary float-right" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- ========================================= POPUP For Phone ========================================== --}}

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
          <div class="modal-footer d-inline-block">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="update-Phone" type="button" class="btn btn-primary float-right" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- =========================================== POPUP For Password ============================================ --}}

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
            <p>You need to Log In again with your new Password.</p>
          </div>
          <div class="modal-footer d-inline-block">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="update-password" type="button" class="btn btn-primary float-right" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- =========================================== POPUP For Password ============================================ --}}

   <!-- Modal -->
    <div class="modal fade" id="DeleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="deleteProfileModalLabel" aria-hidden="true"data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content DeletingAccountModalContent">
          <div class="modal-header">
            <h5 class="modal-title" id="emailModalHeader"> Confirm delete account ? </h5>
         {{--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}
          </div>
          <div class="modal-body">
            <p><strong> Please!</strong> Tell us why are you removing your account?</p>
              <textarea class="form-control reasonAccRem" rows="5" id="removingAccount"></textarea>
          </div>
          <div class="modal-footer d-inline-block">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="delete-profile" type="button" class="btn btn-primary float-right" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- =========================================== POPUP For Password Ending ============================================ --}}


 {{-- @include('site.user.footer') --}} 

<script src="{{asset('/js/lang.js')}}"></script>
<script src="{{ asset('js/site/jquery.formstyler.js') }}"></script>
<script src="{{ asset('js/site/modernizr.js') }}"></script>
<script src="{{ asset('js/site/jquery.popup.js') }}"></script>
<script src="{{ asset('js/site/impact_lib.js') }}"></script>
<script src="{{ asset('js/site/lib.js') }}"></script>
<script src="{{ asset('js/site/script.js') }}"></script>


{{-- <script src="{{ asset('js/site/profile.js') }}"></script>  --}}

<script src="{{ asset('js/site/userProfile.js') }}"></script>

@yield('custom_footer_css')
<style type="text/css">
    h5#emailModalHeader {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    color: #254c8e;
    margin:0 auto;
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
.modal-content.emailModalContent,.modal-content.PhoneModalContent,.modal-content.DeletingAccountModalContent {
    width: 80%;
}
div.modal-content.emailModalContent>.modal-body,div.modal-content.DeletingAccountModalContent>.modal-body {
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
/*.reasonAccRem{
    width: 80%;
}*/
</style>
@yield('custom_js')

<script type="text/javascript">
  $(document).ready(function() {
    $('#delete-profile').attr('disabled', true);
    
    $('.reasonAccRem').on('keyup',function() {
        var textarea_value = $("#removingAccount").val();
        // var text_value = $('input[name="textField"]').val();
        
        if(textarea_value != '') {
            $('#delete-profile').attr('disabled', false);
        } else {
            $('#delete-profile').attr('disabled', true);
        }
    });
});
</script>

</body>
</html>
