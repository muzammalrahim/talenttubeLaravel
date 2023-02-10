{{-- <div class="container"> --}}
  {{-- <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#interviewConciergeModal">
    Login
  </button>   --}}
{{-- </div> --}}

<div class="modal fade" id="interviewConciergeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4 class="font-weight-bold">Interview Concierge</h4>
        </div>
        <div class="d-flex flex-column text-center">
          {{-- <form>  --}}
          <form id="intCon_login" class="intCon_login" method="post" autocomplete="on" action="">
            @csrf
              <div class="form-group">
                <input type="text" id="intConform_mobile" name="mobile" class="form-control" id="email1"placeholder="Your Mobile...">
              </div>

              <div class="form-group">
                <p class="errorInMobile p-0 m-0 text-danger hide errorPtag"> </p> 
              </div>

              <div class="form-group">
                <input type="email" id="intConform_email" class="form-control" name="email" placeholder="Your Email...">
              </div>

              <div class="form-group">
                <p class="errorInEmail p-0 m-0 text-danger hide errorPtag"> </p>  
              </div>

              <div class="form-group">
                <p class="errorInBooking p-0 m-0 text-danger hide errorPtag"> </p>  
              </div>
              <button type="button" id="intConform_login" type="submit" class="btn btn-info btn-block btn-round intConSigninButton">Login</button>

          </form>
          
          {{-- <div class="text-center text-muted delimiter">or use a social network</div> --}}
          <div class="d-flex justify-content-center social-buttons">
            {{-- <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
              <i class="fab fa-twitter"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
              <i class="fab fa-facebook"></i>
            </button>
            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
              <i class="fab fa-linkedin"></i>
            </button> --}}
          </di>
        </div>
      </div>
    </div>
      <div class="modal-footer d-flex justify-content-center">
        {{-- <div class="signup-section">Not a member yet? <a href="#a" class="text-info"> Sign Up</a>.</div> --}}
      </div>
  </div>
</div>




<style type="text/css">
  .container {
  padding: 2rem 0rem;
}

@media (min-width: 576px){
  .modal-dialog {
    max-width: 400px;
    
    .modal-content {
      padding: 1rem;
    }
  }
}

.modal-header {
  .close {
    margin-top: -1.5rem;
  }
}

.form-title {
  margin: -2rem 0rem 2rem;
}

.btn-round {
  border-radius: 3rem;
}

.delimiter {
  padding: 1rem;  
}

.social-buttons {
  .btn {
    margin: 0 0.5rem 1rem;
  }
}

.signup-section {
  padding: 0.3rem 0rem;
}
</style>