
@if ($controlsession->count() > 0)
<div class="adminControl">
        <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
</div>

@endif

@extends('site.user.usermaster')

@section('content')
<div class="cont bl_profile">
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

	        <button type="button" class="emailUpdateBUtton" data-toggle="modal" data-target="#emailModal">Update</button> {{-- c-update-email --}}
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
    	        <button type="button" class="PhoneUpdateBUtton"data-toggle="modal" data-target="#PhoneModal">Update</button>
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
	        <button type="button" class="PasswordUpdateBUtton" data-toggle="modal" data-target="#PasswordModal">Update</button>
            </div>
            <div class="alert alert-success PasswordAlert hide_it2" role="alert">
                <strong>Success!</strong> Password has been updated successfully!
            </div>

            {{-- =================================================== Password  ============================================== --}}


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

@stop

@section('custom_footer_css')
<style type="text/css">
	.jobSeekerProfileHeader,.signOutButtonHeader {
    color: white !important;
}
div#colfix_l {
    height: 310px;
    width: 185px;
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
.emailUpdateBUtton,.PhoneUpdateBUtton,.PasswordUpdateBUtton{
	margin-left: 19px;
    padding: 5px;
    background:#142d69;
	color: white;
    border: 2px solid #142d69;
    width: 75px;
    border-radius: 7px;
    transition: 0.3s;
    opacity: 0.7;
}
.emailUpdateBUtton:hover,.PhoneUpdateBUtton:hover,.PasswordUpdateBUtton:hover{
    opacity: 1.0;
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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.emailLoader').after(getLoader('smallSpinner SaveEmailSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updateEmail',
            data: {'email': updateEmail},
            success: function(resp){
                if(resp.status == true){
                    console.log('email updated successfully');
                    $('.SaveEmailSpinner').remove();
                    // location.reload();
                    window.location = resp.data.logout_Route;
                    // $('#updateEmail').attr("disabled",true);
                    $('.EmailAlert').show().delay(3000).fadeOut('slow');
                }
                else{
                    // console.log(resp.validator[0])
                    $('.emailValidatorErrorText').text(resp.validator[0]);   // fail
                    $('.emailValidatorErrorText').show().delay(3000).fadeOut('slow');
                    $('.SaveEmailSpinner').remove();
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
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.PhoneLoader').after(getLoader('smallSpinner SavePhoneSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updatePhone',
            data: {'phone': updatePhone},
            success: function(resp){
                if(resp.status == true){
                    $('.SavePhoneSpinner').remove();
                    $('.PhoneAlert').show().delay(3000).fadeOut('slow');
                    $('.PhoneValidatorErrorText').addClass('hide_it2');

                }
                else{
                    console.log(resp.validator[0]);
                    $('.PhoneValidatorErrorText').text(resp.validator[0]);
                    $('.SavePhoneSpinner').remove();
                    $('.PhoneValidatorErrorText').removeClass('hide_it2');

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

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.PasswordLoader').after(getLoader('smallSpinner SavePasswordSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/updatePassword',
            data: {'new_password': new_password, 'current_password':current_password},
            success: function(resp){
                if(resp.status == true){
                    $('.SavePasswordSpinner').remove();
                    $('.PasswordAlert').show().delay(3000).fadeOut('slow');
                    $('.PasswordValidatorErrorTextOld').addClass('hide_it2');
                    $('.PasswordValidatorErrorTextNew').addClass('hide_it2');
                }
                else{
                    $('.SavePasswordSpinner').remove();
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

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('.PasswordLoader').after(getLoader('smallSpinner SavePasswordSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/deleteuser',
            data: {'reasonValue': reasonValue},
            success: function(resp){
                if(resp.status == 1){
                    var newpath = '{!! route('homepage') !!}';
                    window.location.href = newpath;
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

