<form method="POST" name="crossReference" class="crossReference newJob job_validation">
            @csrf
            <div class="job_title form_field">
                <span class="form_label">Name :</span>
                <div class="form_input">
                    <input type="text" value="" name="name" class="w20" required>
                    <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Mobile :</span>
                <div class="form_input">
                    <input type="text" value="" name="mobile" class="w20" required>
                    <div id="password_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>


            <div class="job_title form_field">
                <span class="form_label">Email :</span>
                <div class="form_input">
                    <input type="email" value="" name="email" class="w20" required>
                    <div id="email_error" class="error field_error to_hide">&nbsp;</div>
                </div>
            </div>



        <div class="form_field">
            <span class="form_label"></span>
            <div class="form_input">
                <div class="general_error1 error to_hide">&nbsp;</div>
            </div>
        </div>
        <input type="hidden" name="username" value="{{$user->name}}">
        <input type="hidden" name="userId" value="{{$user->id}}">
        <div class="form_field">
            <span class="form_label">Reference:</span>
            <select class="selectReference" name="refType">
                <option>Work Reference</option>
                <option>Personal  Reference</option>
                <option>Educational  Reference</option>
            </select>
        </div>

        {{-- <div class="job_title form_field">
                <span class="form_label">Status</span>
                <select class="selectReference" name="refType">
                    <option>Unable to contact</option>
                    <option>Awaiting Response</option>
                    <option>Reference complete</option>
                    <option>Referee Declined</option>
                </select>
        </div> --}}

        <div class="job_title form_field">
            <span class="form_label">Employer Notification:</span>
                <select name="employerNotification">
                    <option value="0"> Select Employer</option>

                    @foreach ($employer as $employ)
                            <option value=" {{$employ->id}}">{{$employ->name}}</option>
                    @endforeach
                </select>
        </div>

        <p class="errorsInFields text-danger"></p>


        



        <div class="fomr_btn act_field">
            <button class="btn small leftMargin turquoise sendNotification">Send Email</button>
        </div>

</form>

<script type="text/javascript">

$('.sendNotification').on('click',function() {
    event.preventDefault();
    var formData = $('.crossReference').serializeArray();
    $('.sendNotification').html(getLoader('pp_profile_edit_main_loader')).prop('disabled',true);
    console.log(' formData ', formData);
    $('.general_error1').html('');
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/crossReference/sendEmailReferee',
        data: formData,
        success: function(response){
            console.log(' data ', data);
            $('.sendNotification').html('Send Email').prop('disabled',false);
            if( response.status == 1 ){
                $('.errorsInFields').text('Notification sent sucessfully');
                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
            }else{

                  var errorss =  response.validator;
                       var nameError = errorss['name'];
                       var emailError = errorss['email'];
                       var mobileError = errorss['mobile'];
                       
                       // Name Error 
                       if(nameError) {
                            var nameError2 = nameError.toString();
                            $('.errorsInFields').text(nameError2);
                        }       
                       // Email Error 
                       if(emailError){
                           var emailError2 = emailError.toString();
                           $('.errorsInFields').text(emailError2);
                        }
                        // Email Error 
                       if(mobileError){
                       var mobileError2 = mobileError.toString();
                       $('.errorsInFields').text(mobileError2);
                       }

                // $('.errorsInFields').text('Error occured');
               setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },4000);
            }

        }
    });
});

</script>

<style type="text/css">
    .errorsInFields{color:red; margin-left: 15%;}

</style>