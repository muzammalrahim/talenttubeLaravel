$(function () {
    var $ppSignIn=$('#pp_sign_in').modalPopup({shClass: ''});
    function signInClose() {
        if(!$ppSignIn.is(':visible'))return;
        $ppSignIn.close(false,function(){
            hideErrorLoginFrom('#form_login_user', $('input.inp, #form_login_submit, button', '#form_login'))
        })
    }

    $('#pp_sign_in_close').click(function(){
        signInClose();
        return false;
    })

    $('#pp_sign_in_open').click(function(){
        console.log(' open ');
        $ppSignIn.open();
        return false;
    })
 
    var $ppForgotPass=$('#pp_resend_password').modalPopup();
    $('#pp_forgot_pass_open').click(function(){
        //var $shadow=$('<div class="pp_shadow"></div>').hide().prependTo('body').fadeIn('fast');
        $ppSignIn.close(false,function(){
            //$shadow.fadeOut('fast');
            hideErrorLoginFrom('#form_login_user', $('input.inp, #form_login_submit, button', '#form_login'));
            $ppForgotPass.open();
        })
        return false;
    })

    $('.pp_forgot_pass_close').click(function(){
        $ppForgotPass.close(false,function(){
            $ppSignIn.open();
        })
        return false;
    })
    function forgotPassClose() {
        if(!$ppForgotPass.is(':visible'))return;
        $('.pp_forgot_pass_close').click();
    }

    $('#pp_resend_password_email').on('change propertychange input',validateEmailForgotPass);
    function validateEmailForgotPass() {
        var email=trim($('#pp_resend_password_email').val()),
            is=checkEmail(email);
        hideErrorLoginFrom('#pp_resend_password_email', $('#pp_resend_password_email'));
        hideErrorLoginFrom('#pp_resend_password_error', $('#pp_resend_password_email'), '.successful');
        $('#pp_resend_password_submit').prop('disabled',!is);
        return is;
    }

    $('#pp_resend_password_submit').click(function(){
		var url=url_main+'forget_password.php?ajax=1&mail='+$('#pp_resend_password_email').val();
        $('#pp_resend_password_email').prop('disabled', true);
        $('#pp_resend_password_submit').html(getLoader('css_loader_btn', false, true));
		$.get(url, function(data){
            if(data == 'link_send'){
                siteLangParts.send_password=siteLangParts.send_again;
                showErrorLoginFrom('#pp_resend_password_error', siteLangParts.link_password_send, $('#pp_resend_password_submit'), '.successful')
            }else{
                showErrorLoginFrom('#pp_resend_password_email', data, $('#pp_resend_password_submit'));
            }
            $('#pp_resend_password_submit').html(siteLangParts.send_password);
            $('#pp_resend_password_email').prop('disabled', false);
		})
	})

	$('body').on('click', '.pp_wrapper', function(e){
		if($(e.target).is('.pp_wrapper')){
            // signInClose();
            forgotPassClose();
        }
	})

    var $frmLogin = $('#form_login'),
		$frmLoginInput = $('input.inp, #form_login_submit, button', $frmLogin),
        $frmLoginSubmit = $('#form_login_submit'),
        $frmLoginUser = $('#form_login_user'),
        isFrmLoginSubmitAjax = false;

    $frmLogin.submit(function(event) {
        event.preventDefault();
        $('.login_form_errors').removeClass('to_show').addClass('to_hide').text('');
        if(isFrmLoginSubmitAjax)return false;
        isFrmLoginSubmitAjax=true;
        $frmLoginUser.val($.trim($frmLoginUser.val()));
        $(this).ajaxSubmit({success: loginResponse});
        $frmLoginInput.prop('disabled', true);
        // $frmLoginSubmit.html(getLoader('css_loader_login_form',false,true));
        return false;
    });

    $('input.inp', $frmLogin).on('change propertychange input', function(){
        hideErrorLoginFrom('#form_login_user', $frmLoginInput);
    })

	function loginResponse(data) {
        isFrmLoginSubmitAjax=false;
        // console.log(' loginResponse ', data);
        
        // console.log(signinErrorSixChar);

//==================================================== Removing Loader when error occur on Sign in =========================================

        // $('.css_loader_login_form').addClass('hide_it2');



        var signinErrorWrong = data['message'];


        $('.errorMessageLogIn').text(signinErrorWrong);
        

        var form_login_pass = $("#form_login_pass").val();
        if (form_login_pass.length < 6){

        var signinErrorSixChar = data['message']['password'];
        $('.errorMessageLogIn').text(signinErrorSixChar);
        console.log(signinErrorSixChar);
        }



        else{
        var signinErrorWrong = data['message']['email'];
        $('.errorMessageLogIn').text(signinErrorWrong);
        // console.log(signinErrorWrong);

        }

        if(data.status == 1) {
            location.href = data.redirect; // '/laravel/public/profile';
            $frmLoginSubmit.html(i18n.site.signInSuccess);
			return false;
		}else{
            $frmLoginInput.prop('disabled', false);
            $frmLoginSubmit.html(i18n.site.signIn);
            showErrorLoginFrom('#form_login_user', data.message, $frmLoginInput);
            $('.login_form_errors').removeClass('to_hide').addClass('to_show').text(data.message);
			return false;
        }
	}

    function showErrorLoginFrom(el, text, $input, cl){
        var cl=cl||'.error',
            $el=$(el).focus(),$error=$el.next(cl);
        if ($error.is('.to_show')) {
            $error.html(text);
            return;
        }
        var h=$error.html(text).css('height', 'auto').height();
		$error.height(0);
		setTimeout(function(){
			$error.css({height:h}).addClass('to_show');
		},1);
        $input.prop('disabled', false);
    }


//================================== Interview Concierge login  ================================== // 

if( $('#intConc_sign_in').length ){
    var $interviewSignIn = $('#intConc_sign_in').modalPopup({shClass: ''});
    $('.interviewConciergeRoute').click(function(){
        console.log(' open ');
        $interviewSignIn.open();
        return false;
    });
 }


// ================================= interview Log in =================================

$('#intConform_login').click(function ($event) {

        // $('.intConSigninButton').text('Signing in')
        $event.preventDefault();
        event.preventDefault();
        var formData = $('.intCon_login').serializeArray();
        // console.log(' formData ', formData);
        $.ajax({
            type: 'POST',
            url:  base_url + '/interviewConLogin',
            data: formData,
            success: function(response){

            if (response == "") {
                $('.errorInBooking').text('This "Email" and "Mobile" is not registered with any booking.');
                $('.intConSigninButton').text('Signing in Error');

            }else{

                
                    
                if( response.status == 1) {
                    location.href = response.redirect;
                    $('.intConSigninButton').text('Sign in Successfully');
                $('.intConSigninButton').css("background","rgba(0,0,0,.4)");
                console.log(' data >>>> ', response);
                }else{   
                $('.errorInBooking').text('This "Email" and "Mobile" is not registered with any booking.');
                                 
                   var errorIntCon = response['message'];
                   // var nameError = errorIntCon['name'];
                   var mobileError = errorIntCon['mobile'];
                   var emailError = errorIntCon['email'];
                   // console.log(errorInNameCon);

                   // ==================== name validation ====================
                   // if (nameError){
                   //      var nameError2 = nameError.toString();
                   //      $('.errorInName').text(nameError2);
                   //      $('.errorInName').show();
                   //      // console.log(nameError);

                   //  } else {
                   //      $('.errorInName').hide();
                   //  }
                    // ==================== name validation end here ====================

                   // ==================== mobile validation ====================
                   if (mobileError){
                        var mobileError2 = mobileError.toString();
                        $('.errorInMobile').text(mobileError2);
                        $('.errorInMobile').show();
                        console.log(nameError);

                    } else {
                        $('.errorInMobile').hide();
                    }
                    // ==================== mobile validation end here ====================
                    // ==================== email validation ====================
                   if (emailError){
                        var emailError2 = emailError.toString();
                        $('.errorInEmail').text(emailError2);
                        $('.errorInemail').show();
                        // console.log(nameError);

                    } else {
                        $('.errorInemail').hide();
                    }
                    // ==================== email validation end here ====================

                            
                }
            }

            }

        });
}); 

// ================================= interview Log in end here =================================


//================================== Interview Concierge login  ================================== // 

// ================================= Interview Consierge Log in Close onclick =================================

    $('.close_hover').click(function() {
        $('#intConc_sign_in').close();

    });

// ================================= Interview Consierge Log in Close onclick =================================



})

function hideErrorLoginFrom(el, $input,cl){
    cl=cl||'.error';
    $(el).next(cl).removeClass('to_show').css({height:0});
    $input.prop('disabled', false);
}


