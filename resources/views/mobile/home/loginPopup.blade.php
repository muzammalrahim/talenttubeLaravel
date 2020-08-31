

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
      <div class="modal-body p-2 mt-2">
        
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
    
      <form id="m_form_login" style="color: #757575;"  class="text-center" method="post" autocomplete="on" action="{{route('login')}}">
          @csrf
          <input type="hidden" name="login_type" value="site_ajax" >
        <!-- Email -->
        <div class="md-form">
          <input type="email" name="email" id="materialLoginFormEmail" class="form-control black-text" required>
          <label for="materialLoginFormEmail" class="text-info">E-mail</label>
        </div>

        <!-- Password -->
        <div class="md-form">
          <input type="password" name="password" id="materialLoginFormPassword" class="form-control black-text" required>
          <label for="materialLoginFormPassword" class="text-info">Password</label>
        </div>

        <div class="d-flex justify-content-around">
          <div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
              <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
            </div>
          </div>
        </div>

        <!-- Register -->
        <p>Not a member?<a href="">Register</a></p>



        <div class="md-form text-center loginStatus red-text">
             
        </div>



      </form>
    <!-- Form -->
         
        
    
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-primary waves-effect waves-light mSignInBtn">Sign in<i class="fa fa-paper-plane ml-1"></i></a>
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

