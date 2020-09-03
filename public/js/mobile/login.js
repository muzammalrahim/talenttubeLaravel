
$(document).ready(function() {


  // Mobile login. 
    $('.mSignInBtn').on('click',function() {
        $('.mProcessing').removeClass('d-none');
        $('#m_form_login').addClass('d-none');

        var email = $.trim($('#m_form_login input[name="email"]').val());
        var password = $.trim($('#m_form_login input[name="password"]').val());

        if( email == '' || password == '' ){
        	$('#m_form_login .message').html('<p>Please Enter Username and Password</p>')
        }else{



         $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
         $.ajax({
             url: base_url+'/mstep2',
             type : 'POST',
             data : step2_formData,
             processData: false,
             contentType: false,
             success : function(resp) {
                 console.log('resp ', resp);
                 $jq('#join_done').html('Done').prop('disabled',false);
                 if(resp.status){
                     setTimeout(() => {
                         location.href = resp.redirect;
                     }, 1000);
                 }else{
                     $jq('#full_step_8').html('<div class="full_step_error center"><p>Error Updating data.</p></div>');
                     if(resp.validator != undefined){
                         const keys = Object.keys(resp.validator);
                         for (const key of keys) {
                             var error_html = '<p>'+resp.validator[key][0]+'</p>';
                             $('.full_step_error').append(error_html);
                         }
                     }else if(resp.error != undefined ){
                         var error_html = '<p>'+resp.error+'</p>';
                         $('.full_step_error').append(error_html);
                     }
         
                     $('.full_step_error').append('<h3 class="mt20"><a class="pointer" onclick="location.reload()" style="color: #ffa200;">Click here to update</a></h3>');
                 }
             }
         });



        }

          
    });

});
