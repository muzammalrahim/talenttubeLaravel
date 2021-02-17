

<div class="modal fade right" id="mLoginModal" tabindex="-1" role="dialog" aria-labelledby="mLoginModal"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Sign in</p>
        <button type="button" class="close modalCloseTopButton" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">×</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body p-2 mt-3">
        
        <div class="mProcessing d-none text-center">
         <div class="preloader-wrapper big active crazy">
            <div class="spinner-layer spinner-blue-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div>
              <div class="gap-patch">
                <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
    
      <form id="m_form_login" style="color: #757575;"  class="text-center" method="post" autocomplete="on" action="{{route('loginUserInterviewInvitation')}}">
          @csrf
          <input type="hidden" name="login_type" value="site_ajax" >
        <!-- Email -->
        <div class="md-form">
          <input type="email" name="email" id="materialLoginFormEmail" class="form-control black-text pl-2" required style="margin-bottom: 31px;">
          <label for="materialLoginFormEmail" class="text-info"><h6 class=" ml-1">E-mail</h6></label>
        </div>

        <!-- Password -->
        <div class="md-form my-4">
          <input type="password" name="password" id="materialLoginFormPassword" class="form-control black-text pl-2" required>
          <label for="materialLoginFormPassword" class="text-info"><h6 class="ml-1">Password</h6></label>
        </div>

        {{-- <p class="errorToShow">Hi there how are u</p> --}}
        <div class="md-form text-center loginStatus red-text" style="font-size: 12px;">

        </div>

        <div class="d-flex row">
          {{-- <div> --}}
            <div class="form-check p-0 col">
              <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
              <label class="form-check-label text-primary pl-4" for="materialLoginFormRemember">Remember me</label>
            </div>

            <div class="col">
                <a class="text-primary float-right" data-toggle="modal" data-target="#modalLoginForm" data-dismiss="modal">Forget Password?</a>
            </div>
          {{-- </div> --}}
        </div>

        <!-- Register -->

      <div>

      <div class="d-flex mt-2 mb-1 float-right">

      <a href="" class="">Register?</a>
      </div>
      <div class="d-flex">
      </div>

      </div>

      </form>
    <!-- Form -->

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-primary waves-effect waves-light interviewInvitationSignInBtn">Sign in<i class="fa fa-paper-plane ml-1"></i></a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

{{-- <style type="text/css">
  label.text-info{
    /*font-size: 15px !important;*/
    margin-left: 4px;
    font-weight: 600;
    color: black !important;
}
</style> --}}


{{-- ==================================== Forget Password ============================ --}}

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center text-white bg-primary">
        <h6 class="modal-title w-100 font-weight-bold">Forgot your password</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">

        <div class="row">

        <div class="col-1">  
        <i class="fas fa-lock prefix grey-text float-left"></i></div>
        <div class="col text-center">
        <p style="font-size: 13px;"> Please enter your email address we will send you a link to reset your password</p>
        </div>

        </div>

        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email" placeholder="Your email">Your email</label>
        </div>

{{--         <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="defaultForm-pass" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-pass">Your password</label>
        </div> --}}

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary">Reset Password</button>
      </div>
    </div>
  </div>
</div>

{{-- <div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Launch
    Modal Login Form</a>
</div> --}}

{{-- ================================================ Interview COncierge Pop Up ================================================ --}}

<div class="modal fade right" id="mIntConLogin" tabindex="-1" role="dialog" aria-labelledby="mIntConLogin"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Interview Concierge</p>
        <button type="button" class="close modalCloseTopButton" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">×</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body p-2 mt-3">
        
        <div class="mProcessing d-none text-center">
         <div class="preloader-wrapper big active crazy">
            <div class="spinner-layer spinner-blue-only">
              <div class="circle-clipper left">
                <div class="circle"></div>
              </div>
              <div class="gap-patch">
                <div class="circle"></div>
              </div>
              <div class="circle-clipper right">
                <div class="circle"></div>
              </div>
            </div>
          </div>
        </div>
    
      <form id="MintCon_login" style="color: #757575;"  class="MintCon_login text-center" method="post" autocomplete="on" action="{{-- {{route('login')}} --}}">
          @csrf
        <!-- Mobile -->
        <div class="md-form my-4">
          <input type="text" id="materialLoginFormPassword"  type="text" name="mobile" class="form-control black-text pl-2">
          <label for="materialLoginFormPassword" class="text-info"><h6 class="ml-1">Mobile</h6></label>
          <p class="errorInMobile p-0 m-0 text-danger hide errorPtag"> </p> 
        </div>
        <!-- Email -->
        <div class="md-form mb-4">
          <input type="text" id="materialLoginFormEmail"  type="text" name="email" class="form-control black-text pl-2">
          <label for="materialLoginFormEmail" class="text-info"><h6 class=" ml-1">E-mail</h6></label>
          <p class="errorInEmail p-0 m-0 text-danger hide errorPtag"> </p> 
        </div>
        <div class="bl_remember">
            <p class="errorInBooking p-0 m-0 text-danger hide errorPtag"> </p>  
        </div>

      </form>
    <!-- Form -->
    
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" id="MintConform_login" class="btn btn-primary waves-effect waves-light interviewConciergeRoute tohideFormOnClick">Sign in<i class="fa fa-paper-plane ml-1"></i></a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

{{-- ================================================ Interview COncierge Pop Up ================================================ --}}
