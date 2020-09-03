@extends('mobile.user.usermaster')

@section('content')
<div class="cont bl_profile">
    <div class="bl_pic_info  my_profile">
        <div class="cl"></div>

            <div class="sectionUpdateProfile text-center mb-1"><b>Update Email Address</b></div>

            {{-- @dump($user); --}}

	        {{-- ============================ Email ====================================== --}}

	        <div class="form-group row">
	            {{-- {{ Form::label('email', null, ['class' => 'col-md-3 form-control-label']) }} --}}
	            <div class="col-md-12 emailLoader">
	              {{ Form::text('email', $value = $user->email , $attributes = array('class'=>'form-control', 'placeholder' => 'email','required'=> 'false', 'id'=>'updateEmail','name'=>'userUpdatedEmail' )) }}
	              <p class="emailValidatorErrorText hide" style="color: #dc3545"> </p>
	            </div>
	        </div>



	        <div class="col-md-3"></div>
	        <button type="button" class="emailUpdateBUtton btn btn-sm btn-primary ml-0" data-toggle="modal" data-target="#emailModal">Update</button> {{-- c-update-email --}}

	        <div class="alert alert-success EmailAlert hide_it2" role="alert">
	            <strong>Success!</strong> Email has been updated successfully!
	        </div>

	        {{-- ============================ Email Ending ====================================== --}}


	        {{-- ============================ Phone Number ====================================== --}}

            <div class="sectionUpdateProfile mt-3 text-center mb-1"><b>Update Phone Number</b></div>
	        <div class="form-group row">
	            {{-- {{ Form::label('Phone', null, ['class' => 'col-md-3 form-control-label']) }} --}}
	            <div class="col-md-12 PhoneLoader">
	              {{ Form::text('phone', $value = $user->phone , $attributes = array('class'=>'form-control', 'placeholder' => 'Phone','required'=> 'false','id'=>'updatePhone',)) }}
	              <p class="PhoneValidatorErrorText hide" style="color: #dc3545;"> </p>

	            </div>
	        </div>

	        <div class="col-md-3"></div>
	        <button type="button" class="PhoneUpdateBUtton btn btn-sm btn-primary ml-0"data-toggle="modal" data-target="#PhoneModal">Update</button>
	        <div class="alert alert-success PhoneAlert" role="alert" style="display: none;">
	            <strong>Success!</strong> Phone has been updated successfully!
	        </div>

	        {{-- =============================================  Phone Number Ending ========================================= --}}

	        {{-- =================================================== Password  ============================================== --}}


            <div class="sectionUpdateProfile mt-3 text-center mb-1"><b>Update Password</b></div>

            <div class="form-group row">
                {{-- {{ Form::label('current password', null, ['class' => 'col-md-3 form-control-label']) }} --}}
                <div class="col-md-12">
                 {{--  {{ Form::text('current_password', '' , $attributes = array('class'=>'form-control', 'placeholder' => 'Current Password','required'=> 'false','id'=>'current_password')) }} --}}
                  {{ Form::password('current_password', ['class' => 'form-control'])}}
                  <p class="PasswordValidatorErrorTextOld hide" style="color: #dc3545;;"> </p>
                </div>
            </div>

            <div class="form-group row">
                {{-- {{ Form::label('new password', null, ['class' => 'col-md-3 form-control-label']) }} --}}
                <div class="col-md-12 PasswordLoader">
             {{--      {{ Form::text('new_password', '' , $attributes = array('class'=>'form-control', 'placeholder' => 'New Password','required'=> 'false','id'=>'new_password')) }} --}}
                  {{ Form::password('new_password', ['class' => 'form-control'])}}

                  <p class="PasswordValidatorErrorTextNew hide" style="color: #dc3545;"> </p>

                </div>
            </div>

            <div class="col-md-3"></div>
	        <button type="button" class="PasswordUpdateBUtton btn btn-sm btn-primary ml-0" data-toggle="modal" data-target="#PasswordModal">Update</button>
            <div class="alert alert-success PasswordAlert" role="alert" style="display:none;">
                <strong>Success!</strong> Password has been updated successfully!
            </div>

            {{-- =================================================== Password  ============================================== --}}


	        {{-- ================================================= Delete Account =========================================== --}}


            <div class="sectionUpdateProfile mt-3 text-center mb-1"><b>Delete Account</b></div>
	        <div class="form-group row">
	            {{ Form::label('Delete My Account', null, ['class' => 'col-md-12 form-control-label']) }}
	            <div class="col-md-9">
	 			<button type="button" class="DeleteProfileBUtton btn btn-sm btn-danger ml-0" data-toggle="modal" data-target="#DeleteProfileModal" user_id = "{{$user->id}}">Delete</button>
	            </div>
	        </div>


            {{-- ============================================== Delete Account Ending ======================================== --}}

    </div>

	<div class="cl" style="float:left"></div>

</div>

{{-- ================================== Including File of Modals here ================================== --}} 

 @include('mobile.user.profile.ModalUserPersonalSetting')


@stop

@section('custom_footer_css')
<style type="text/css">
	.jobSeekerProfileHeader,.signOutButtonHeader {
    color: white !important;
}
div#colfix_l {
    height: 310px;
}
div.cont_w>.column_main {
    min-height: 700px;
}
.column_main .col_center .cont.bl_profile .my_profile {
    /*margin: 2% 10% 0px 10%;*/
}
.sectionUpdateProfile{
	height: 35px;
    width: 100%;
    font-size: 18px;
    color: #254c8e;
    margin-bottom: 20px;
    border-radius: 10px;
}

.alert.alert-success.EmailAlert,.alert.alert-success.PhoneAlert,.alert.alert-success.PasswordAlert {
    /*margin: 15px 26%;*/
    width: 100%;
}
.smallSpinner.SaveEmailSpinner,.smallSpinner.SavePhoneSpinner,.smallSpinner.SavePasswordSpinner {
    position: relative;
    float: left;
    font-size: 20px;
    margin-top: 15px;

}
p.emailValidatorErrorText,p.PhoneValidatorErrorText {
    margin: 0px;
}

</style>
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
@stop

@section('custom_js')

<script type="text/javascript">

 // ====================================================== Update Email Ajax ============================================

    $(document).ready(function (){
    	$('.emailUpdateBUtton').click(function(){
    		 var updateEmail = $('#updateEmail').val();
    		$('.updatedEmailInModal').html(updateEmail);
    	});

        $('#c-update-email').on('click', function(){
        console.log('hi');
        var updateEmail = $('#updateEmail').val();
        console.log(updateEmail);
        $('#centralModalSuccess').show().delay(1000).fadeOut('slow');

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateEmail',
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
                    // centralModalSuccess
                    // $('.SaveEmailSpinner').remove();
                }
            }
        });
        });
    });

 // =========================================== Update Email Ajax End here ===========================================
 
 // =============================================== Update Phone Ajax ================================================

    $(document).ready(function (){
    	$('.PhoneUpdateBUtton').click(function(){
    		 var updatePhone = $('#updatePhone').val();
    		$('.updatedPhoneInModal').html(updatePhone);
    	});
        $('#update-Phone').on('click', function(){
        console.log('hi');
        var updatePhone = $('#updatePhone').val();
        console.log(updatePhone);
        $('#centralModalSuccess').show().delay(1000).fadeOut('slow');
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('.PhoneLoader').after(getLoader('smallSpinner SavePhoneSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdatePhone',
            data: {'phone': updatePhone},
            success: function(resp){
                if(resp.status == true){
                    // $('.SavePhoneSpinner').remove();
                    $('.PhoneAlert').css("display","block").delay(3000).fadeOut('slow');
                    // $('.PhoneValidatorErrorText').show();
                }
                else{
                    console.log(resp.validator[0]);
                    $('.PhoneValidatorErrorText').text(resp.validator[0]);
                    // $('.SavePhoneSpinner').remove();
                    $('.PhoneValidatorErrorText').show().delay(3000).fadeOut('slow');

                }
            }
        });
        });
    });

 // =========================================== Update Phone Ajax End here ==============================================


 // =============================================== Update Password Ajax ================================================

    $(document).ready(function (){

        $('#update-password').on('click', function(){
        // console.log('hi');
        var new_password 	 = $('input[name="new_password"]').val();
        var current_password  = $('input[name="current_password"]').val();
        
        // console.log(new_password);
        $('#centralModalSuccess').show().delay(1000).fadeOut('slow');
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('.PasswordLoader').after(getLoader('smallSpinner SavePasswordSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdatePassword',
            data: {'new_password': new_password, 'current_password':current_password},
            success: function(resp){
                if(resp.status == true){
                    // $('.SavePasswordSpinner').remove();
                    // $('.PasswordAlert').css("display","block").delay(3000).fadeOut('slow');
                    $('.PasswordAlert').css("display","block").delay(3000).fadeOut('slow');

                    $('.PasswordValidatorErrorTextOld').hide();
                    $('.PasswordValidatorErrorTextNew').hide();  

                    // location.href = base_url+'/m/logout';
                }
                else{
                    // $('.SavePasswordSpinner').remove();
                    var CPR = resp.validator['current_password'];
                    console.log(CPR);
                    var NPR = resp.validator['new_password'];
                    console.log(NPR);
                    $('.PasswordValidatorErrorTextOld').text(CPR);
                    $('.PasswordValidatorErrorTextNew').text(NPR);
                    $('.PasswordValidatorErrorTextOld').show();
                    $('.PasswordValidatorErrorTextNew').show();

                }
            }
        });
        });

    });

 // =========================================== Update Password Ajax End here ===========================================


  // =============================================== Delete Profile Ajax ================================================

    $(document).ready(function (){

        $('#delete-profile').on('click', function(){
        console.log('hi');
        var reasonValue = $('.reasonAccRem').val();
        // var current_password  = $('input[name="current_password"]').val();
        
        console.log(reasonValue);
        $('#centralModalSuccess').show().delay(1000).fadeOut('slow');
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('.PasswordLoader').after(getLoader('smallSpinner SavePasswordSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/Mdeleteuser',
            data: {'reasonValue': reasonValue},
            success: function(resp){
                if(resp.status == true){
                    // $('.SavePasswordSpinner').remove();
                    // $('.PasswordAlert').show().delay(3000).fadeOut('slow');
                    // $('.PasswordValidatorErrorTextOld').addClass('hide_it2');
                    // $('.PasswordValidatorErrorTextNew').addClass('hide_it2');  
                }
                else{
                    // $('.SavePasswordSpinner').remove();
                    // var CPR = resp.validator['current_password'];
                    // console.log(CPR);
                    // var NPR = resp.validator['new_password'];
                    // console.log(NPR);
                    // $('.PasswordValidatorErrorTextOld').text(CPR);
                    // $('.PasswordValidatorErrorTextNew').text(NPR);
                    // $('.PasswordValidatorErrorTextOld').removeClass('hide_it2');
                    // $('.PasswordValidatorErrorTextNew').removeClass('hide_it2');
                }
            }
        });

        });

    });

 // =========================================== Delete Profile Ajax End here ===========================================


</script>

@stop

