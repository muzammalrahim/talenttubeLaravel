


@extends('web.user.usermaster')

@section('content')
<div class="cont profile profile-section">
    <div class="bl_pic_info  my_profile">
        <div class="cl"></div>

            <div class="sectionUpdateProfile"><b>Update Email Address</b></div>

	        {{-- ============================ Email ====================================== --}}

	        <div class="form-group row">
	            {{ Form::label('email', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-5 emailLoader">
	              {{ Form::text('email', $value = $user->email , $attributes = array('class'=>'form-control', 'placeholder' => 'email','required'=> 'false', 'id'=>'updateEmail','name'=>'userUpdatedEmail' )) }}
	              <p class="emailValidatorErrorText hide_it2" style="color: #dc3545"> </p>
	            </div>
	        </div>


            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-9">  
                   <button type="button" class="emailUpdateBUtton orange_btn" data-toggle="modal" data-target="#emailModal">Update</button> {{-- c-update-email --}}
                </div>
            </div>
	        <div class="alert alert-success EmailAlert hide_it2" role="alert">
	            <strong>Success!</strong> Email has been updated successfully!
	        </div>

	        {{-- ============================ Email Ending ====================================== --}}


	        {{-- ============================ Phone Number ====================================== --}}

            <div class="sectionUpdateProfile"><b>Update Phone Number</b></div>
	        <div class="form-group row">
	            {{ Form::label('Phone', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-5 PhoneLoader">
	              {{ Form::text('phone', $value = $user->phone , $attributes = array('class'=>'form-control', 'placeholder' => 'Phone','required'=> 'false','id'=>'updatePhone',)) }}
	              <p class="PhoneValidatorErrorText hide_it2" style="color: #dc3545;"> </p>

	            </div>
	        </div>
            <div class="row">
    	        <div class="col-md-3"></div>
                <div class="col-9">
        	        <button type="button" class="PhoneUpdateBUtton orange_btn"data-toggle="modal" data-target="#PhoneModal">Update</button>
                </div>
            </div>
	        <div class="alert alert-success PhoneAlert hide_it2" role="alert">
	            <strong>Success!</strong> Phone has been updated successfully!
	        </div>

	        {{-- =============================================  Phone Number Ending ========================================= --}}

	        {{-- =================================================== Password  ============================================== --}}


            <div class="sectionUpdateProfile"><b>Update Password</b></div>

            <div class="form-group row">
                {{ Form::label('current password', null, ['class' => 'col-md-3 form-control-label']) }}
                <div class="col-md-5">
                 {{--  {{ Form::text('current_password', '' , $attributes = array('class'=>'form-control', 'placeholder' => 'Current Password','required'=> 'false','id'=>'current_password')) }} --}}
                  {{ Form::password('current_password', ['class' => 'form-control'])}}
                  <p class="PasswordValidatorErrorTextOld hide_it2" style="color: #dc3545;;"> </p>
                </div>
            </div>

            <div class="form-group row">
                {{ Form::label('new password', null, ['class' => 'col-md-3 form-control-label']) }}
                <div class="col-md-5 PasswordLoader">
             {{--      {{ Form::text('new_password', '' , $attributes = array('class'=>'form-control', 'placeholder' => 'New Password','required'=> 'false','id'=>'new_password')) }} --}}
                  {{ Form::password('new_password', ['class' => 'form-control'])}}

                  <p class="PasswordValidatorErrorTextNew hide_it2" style="color: #dc3545;"> </p>

                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-9">
                    <button type="button" class="PasswordUpdateBUtton orange_btn" data-toggle="modal" data-target="#PasswordModal">Update</button>
                </div>
            </div>
            <div class="alert alert-success PasswordAlert hide_it2" role="alert">
                <strong>Success!</strong> Password has been updated successfully!
            </div>

            {{-- =================================================== Turn off all the email notification  ============================================== --}}

            <div class="sectionUpdateProfile"><b>Turn off Email Notificaiton</b></div>
            <div class="form-group row">
                {{ Form::label('Turn off Email Notification', null, ['class' => 'col-md-3 form-control-label']) }}
                <div class="col-md-9">
                    
                  {{-- <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked> --}}

                  <label class="switch">
                    <input type="checkbox" class="default" id="turnOffEmailNotification" {{ $user->email_notification == 1 ? 'checked':'' }} onchange="turnOffEmailNotification()">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

	        {{-- ================================================= Delete Account =========================================== --}}


            <div class="sectionUpdateProfile"><b>Delete Account</b></div>
	        <div class="form-group row">
	            {{ Form::label('Delete My Account', null, ['class' => 'col-md-3 form-control-label']) }}
	            <div class="col-md-9">
	 			<button type="button" class="DeleteProfileBUtton" data-toggle="modal" data-target="#DeleteProfileModal" user_id = "{{$user->id}}">Delete</button>
	            </div>
	        </div>

            {{-- ============================================== Delete Account Ending ======================================== --}}

    </div>

	<div class="cl" style="float:left"></div>

</div>



{{-- =============================================== Email Modal =============================================== --}}

<div class="modal fade" id="emailModal" role="dialog">
    <div class="modal-dialog delete-applications">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                <h1 class="modal-title"><i class="fad fa-refresh"></i>Confirm Update Email</h1>
            </div>
            <div class="modalBody p-3">
    
                <p class="m-0"> After clicking "Confirm" you will be logout !</p>
                <p class="m-0">To continue your session on "TalentTube" </p>
                <p class="m-0">You need to Log In again with your new Email Address.</p>
                <p class="m-0 textNewEmailAddress">Your new Email Address will be:</p><p class="updatedEmailInModal"></p>

                <div class="dual-footer-btn">
                    <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button type="button" class="orange_btn" onclick="updateEmailFunction()" data-dismiss="modal" ><i class="fa fa-check"></i>Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- =============================================== Phone Modal =============================================== --}}


<div class="modal fade" id="PhoneModal" role="dialog">
    <div class="modal-dialog delete-applications">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                <h1 class="modal-title"><i class="fad fa-refresh"></i>Confirm Update Phone</h1>
            </div>
            <div class="modalBody p-3">
    
                <p class="m-0"> After clicking "Confirm" your phone number will be updated !</p>
                <p class="m-0 textNewEmailAddress">Your new Phone Number will be:</p><p class="updatedPhoneInModal"></p>

                <div class="dual-footer-btn">
                    <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button type="button" class="orange_btn" onclick="updatePhoneFunction()" data-dismiss="modal" ><i class="fa fa-check"></i>Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- =============================================== Password Modal =============================================== --}}

<div class="modal fade" id="PasswordModal" role="dialog">
    <div class="modal-dialog delete-applications">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                <h1 class="modal-title"><i class="fad fa-refresh"></i>Confirm Update Password</h1>
            </div>
            <div class="modalBody p-3">
                <p class="m-0"> After clicking "Confirm" you will be logout !</p>
                <p class="m-0">To continue your session on "TalentTube" </p>
                <p class="m-0">You need to Log In again with your new Password.</p>

                <div class="dual-footer-btn mt-3">
                    <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button type="button" id="update-password" class="orange_btn" onclick="updatePasswordFunction()" data-dismiss="modal" ><i class="fa fa-check"></i>Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- =============================================== Delete Account Modal =============================================== --}}

<div class="modal fade" id="DeleteProfileModal" role="dialog">
    <div class="modal-dialog delete-applications">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                <h1 class="modal-title"><i class="fad fa-refresh"></i>Confirm Delete</h1>
            </div>
            <div class="modalBody p-3">
                <div class="deletingIcon text-center text-danger mb-2">
                    <i class="fas fa-times fa-4x animated rotateIn"></i>
                </div>
                <p> <strong> Please!</strong> Tell us why are you removing your account?</p>
                <textarea class="form-control reasonAccRem" rows="3" id="removingAccount"></textarea>

                <div class="dual-footer-btn mt-3">
                    <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button type="button" id="delete-profile" class="orange_btn" onclick="deleteProfileFunction()" data-dismiss="modal" ><i class="fa fa-check"></i>Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>



@stop

@section('custom_footer_css')
<style type="text/css">



.sectionUpdateProfile{
	height: 35px;
    width: 100%;
    font-size: 18px;
    color: #254c8e;
    margin-bottom: 20px;
    border-radius: 10px;
}


.DeleteProfileBUtton{
	margin-left: 5px;
    padding: 5px;
	background: #dc3545;
	color: white;
    width: 75px;
    border-radius: 7px;
    transition: 0.3s;
        border: none;
    /*opacity: 0.7;*/
}
.DeleteProfileBUtton:hover{
	background: #c82333;

}
.alert.alert-success.EmailAlert,.alert.alert-success.PhoneAlert,.alert.alert-success.PasswordAlert {
    margin: 15px 26%;
    width: 40%;
}

p.emailValidatorErrorText,p.PhoneValidatorErrorText {
    margin: 0px;
}
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
/*  float:right;*/
}

/* Hide default HTML checkbox */
.switch input {display:none;}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
      border-radius: 20px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
      border-radius: 20px;
}

input.default:checked + .slider {
  background-color: #f48128;
}


input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
{{-- <link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}"> --}}
{{-- <link rel="stylesheet" href="{{ asset('css/site/profile.css') }}"> --}}

@stop

@section('custom_js')

<script type="text/javascript">

 // ====================================================== Update Email Ajax ============================================

    $(document).ready(function (){
    	$('.emailUpdateBUtton').click(function(){
    		 var updateEmail = $('#updateEmail').val();
    		$('.updatedEmailInModal').html(updateEmail);
    	});

        this.updateEmailFunction = function(){

            // $('#c-update-email').on('click', function(){
            var updateEmail = $('#updateEmail').val();
            console.log(updateEmail);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $('.emailLoader').after(getLoader('smallSpinner SaveEmailSpinner'));

            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/updateEmail',
                data: {'email': updateEmail},
                success: function(resp){
                    if(resp.status == true){
                        console.log('email updated successfully');
                        // $('.SaveEmailSpinner').remove();
                        // location.reload();
                        window.location = resp.data.logout_Route;
                        // $('#updateEmail').attr("disabled",true);
                        $('.EmailAlert').show().delay(3000).fadeOut('slow');
                    }
                    else{
                        // console.log(resp.validator[0])
                        $('.emailValidatorErrorText').text(resp.validator[0]);   // fail
                        $('.emailValidatorErrorText').show().delay(3000).fadeOut('slow');
                        // $('.SaveEmailSpinner').remove();
                    }
                }
            });
            // });

        } 



    });

 // =========================================== Update Email Ajax End here ===========================================

 // =============================================== Update Phone Ajax ================================================

    $(document).ready(function (){
    	$('.PhoneUpdateBUtton').click(function(){
    		 var updatePhone = $('#updatePhone').val();
    		$('.updatedPhoneInModal').html(updatePhone);
    	});

        this.updatePhoneFunction = function(){

        // $('#update-Phone').on('click', function(){
        var updatePhone = $('#updatePhone').val();
        console.log(updatePhone); 
           $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        // $('.PhoneLoader').after(getLoader('smallSpinner SavePhoneSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updatePhone',
            data: {'phone': updatePhone},
            success: function(resp){
                if(resp.status == true){
                    // $('.SavePhoneSpinner').remove();
                    $('.PhoneAlert').show().delay(3000).fadeOut('slow');
                    $('.PhoneValidatorErrorText').addClass('hide_it2');
                }
                else{
                    console.log(resp.validator[0]);
                    $('.PhoneValidatorErrorText').text(resp.validator[0]);
                    // $('.SavePhoneSpinner').remove();
                    $('.PhoneValidatorErrorText').removeClass('hide_it2');

                }
            }
        });
        // });

        }

    });

 // =========================================== Update Phone Ajax End here ==============================================


 // =============================================== Update Password Ajax ================================================

    $(document).ready(function (){

        // $('#update-password').on('click', function(){
        // console.log('hi');
        this.updatePasswordFunction = function(){
            var new_password 	 = $('input[name="new_password"]').val();
            var current_password  = $('input[name="current_password"]').val();

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            // $('.PasswordLoader').after(getLoader('smallSpinner SavePasswordSpinner'));

            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/updatePassword',
                data: {'new_password': new_password, 'current_password':current_password},
                success: function(resp){
                    if(resp.status == true){
                        // $('.SavePasswordSpinner').remove();
                        $('.PasswordAlert').show().delay(3000).fadeOut('slow');
                        $('.PasswordValidatorErrorTextOld').addClass('hide_it2');
                        $('.PasswordValidatorErrorTextNew').addClass('hide_it2');
                    }
                    else{
                        // $('.SavePasswordSpinner').remove();
                        var CPR = resp.validator['current_password'];
                        console.log(CPR);
                        var NPR = resp.validator['new_password'];
                        console.log(NPR);
                        $('.PasswordValidatorErrorTextOld').text(CPR);
                        $('.PasswordValidatorErrorTextNew').text(NPR);
                        $('.PasswordValidatorErrorTextOld').removeClass('hide_it2');
                        $('.PasswordValidatorErrorTextNew').removeClass('hide_it2');
                    }
                }
            });
        }
        // });

    });

 // =========================================== Update Password Ajax End here ===========================================


  // =============================================== Delete Profile Ajax ================================================

    $(document).ready(function (){

        // $('#delete-profile').on('click', function(){
        this.deleteProfileFunction = function(){
            console.log('hi');
            var reasonValue = $('.reasonAccRem').val();
            console.log(reasonValue);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/deleteuser',
                data: {'reasonValue': reasonValue},
                success: function(resp){
                    if(resp.status == 1){
                        var newpath = '{!! route('homepage') !!}';
                        window.location.href = newpath;
                    }
                    else{

                    }
                }
            });
        }


        this.turnOffEmailNotification = function(){
            var val = $('#turnOffEmailNotification').prop('checked');
            let notification=1;
            if (val) {
                notification = 1
            }else{
                notification = 0;
            }
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: 'POST',
                url: base_url+'/ajax/emailnotification',
                data: {'notification': notification},
                success: function(resp){
                    if(resp.status == 1){
                        alert(resp.message);
                    }
                    else{

                    }
                }
            });
        }


    });

 // =========================================== Delete Profile Ajax End here ===========================================


</script>

@stop

