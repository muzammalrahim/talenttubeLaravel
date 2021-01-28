{{-- ========================================= POPUP For Email========================================== --}}

    <!-- Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true"data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content emailModalContent">
          <div class="modal-header bg-info">
            <h5 class="modal-title text-white" id="emailModalHeader"> Confirm Update Email </h5>
         {{--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}
          </div>
          <div class="modal-body">
          <div class="text-center text-info">
              <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
          </div>

            <p> After clicking "Confirm" you will be logout !</p>
            <p>To continue your session on "TalentTube" </p>
            <p>You need to Log In again with your new Email Address.</p>
            <p class="textNewEmailAddress">Your new Email Address will be:</p><p class="updatedEmailInModal"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="c-update-email" type="button" class="btn btn-primary" data-dismiss="modal" {{-- data-toggle="modal" data-target="#centralModalSuccess" --}}>Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- ========================================= POPUP For Email Ending ========================================== --}}

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
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="update-Phone" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- ========================================= POPUP For Phone Ending ========================================== --}}

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
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="update-password" type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- =========================================== POPUP For Password Ending ============================================ --}}

{{-- =========================================== POPUP For Deleting Account ============================================ --}}

   <!-- Modal -->
    <div class="modal fade" id="DeleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="deleteProfileModalLabel" aria-hidden="true"data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content DeletingAccountModalContent">
          <div class="modal-header bg-danger">
            <h5 class="modal-title" id="emailModalHeader"> Confirm delete account ? </h5>
         {{--    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> --}}
          </div>
          <div class="modal-body">

            <div class="deletingIcon text-center text-danger mb-2">
              <i class="fas fa-times fa-4x animated rotateIn"></i>
            </div>
            <p><strong> Please!</strong> Tell us why are you removing your account?</p>
              <textarea class="form-control reasonAccRem" rows="5" id="removingAccount"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal"style="float:left;">Cancel</button>
            <button id ="delete-profile" type="button" class="btn btn-danger" data-dismiss="modal">Confirm</button>
          </div>
        </div>
      </div>
    </div>

{{-- =========================================== POPUP For Deleting Account Ending ============================================ --}}




{{-- =========================================== Loader for ajax call =========================================== --}}

<div class="modal" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success" role="document">

      <div class="modal-body">
        <div class="text-center">

        <div class="spinner-grow text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>

        </div>
      </div>

  </div>
</div>


<style type="text/css">
    h5#emailModalHeader {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    color: white;
    margin: 0px auto;
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
    width: 100%;
}
div.modal-content.emailModalContent>.modal-body,div.modal-content.DeletingAccountModalContent>.modal-body {
    margin: 0px auto;
    width: 100%;

}
div.modal-content.PhoneModalContent>.modal-body {
    margin: 0px auto;
    width: 85%;

}
div.modal-content.emailModalContent>div.modal-body>p,div.modal-content.PhoneModalContent>div.modal-body>p {
    /*margin: 0px 0px 0px 0px;*/
    line-height: 15px;
}
/*.reasonAccRem{
    width: 80%;
}*/


/*div#centralModalSuccess {
    height: 100%;
    width: 100%;
    background: #21252940;
}*/

.modal-dialog.modal-notify.modal-success {
    margin-top: 60%;
}

</style>

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


