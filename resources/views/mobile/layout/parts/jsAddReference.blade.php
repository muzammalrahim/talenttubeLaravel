<form method="POST" name="crossReference" class="crossReference newJob job_validation">
            @csrf

            <div class="form-outline">
              <label class="form-label" for="nameId">Name</label>
              <input type="text" id="nameId" class="form-control" name="name">
              <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
            </div>

            <div class="form-outline">
              <label class="form-label" for="phone">Mobile</label>
              <input type="text" id="phone" class="form-control" name="mobile">
              <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
            </div>

            <div class="form-outline">
              <label class="form-label" for="email">Email</label>
              <input type="text" id="email" class="form-control" name="email">
              <div id="bookingid_error" class="error field_error to_hide">&nbsp;</div>
            </div>
        

        <input type="hidden" name="username" value="{{$user->name}}">
        <input type="hidden" name="userId" value="{{$user->id}}">

        <div class="form-outline">
              <label class="form-label" for="refType">Reference</label>
                <select class="selectReference custom-select" name="refType">
                  <option>Work Reference</option>
                  <option>Personal  Reference</option>
                  <option>Educational  Reference</option>
              </select>
        </div>

        <div class="form-outline my-3">
              <label class="form-label" for="employerNotification">Employer Notification</label>
                <select name="employerNotification" class="custom-select">
                    <option value="0"> Select Employer</option>

                    @foreach ($employer as $employ)
                            <option value=" {{$employ->id}}">{{$employ->name}}</option>
                    @endforeach
                </select>
        </div>

        <p class="errorsInFields text-danger"></p>
        
        <div class="row">
          <div class="col-6">
            <div class="fomr_btn act_field">
                <button class="btn btn-sm btn-primary sendNotification">Send Email</button>
            </div>
          </div>

          <div class="col-3 mt-1">
            <div class="spinner-border text-primary sendEmailSpinner d-none" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>

        </div>
        

</form>

<script type="text/javascript">
$('.sendNotification').on('click',function() {
    event.preventDefault();
    var formData = $('.crossReference').serializeArray();
    $('.sendEmailSpinner').removeClass('d-none');
    console.log(' formData ', formData);
    $('.general_error1').html('');
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/crossReference/MsendEmailReferee',
        data: formData,
        success: function(response){
            console.log(' Data ', formData);
            $('.sendNotification').html('Send Email').prop('disabled',false);
            if( response.status == 1 ){
                $('.errorsInFields').text('Notification sent sucessfully');
                $('.sendEmailSpinner').addClass('d-none');

                setTimeout(() => { $('.errorsInFields').removeClass('to_show').addClass('to_hide').text(''); },3000);
            }else{
                  $('.sendEmailSpinner').addClass('d-none');
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