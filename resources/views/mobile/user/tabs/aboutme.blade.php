 
  		<div class="aboutMeSection"><b>About Me: </b>
        <div class="spinner-border spinner-border-sm text-primary AboutMeLoader ml-2" role="status" style="display:none;"></div>
        <i class="fas fa-edit float-right aboutMeSecButton"></i> <p class="aboutMeSec">{{$user->about_me}}</p>
      </div>
      <div class="col-md-12 text-center my-2">
          <a class="btn btn-sm btn-success saveAboutMeButton d-none">Save</a>
      </div>
      <div class="alert alert-success AboutMeAlert" role="alert" style="display:none;">
        <strong>Success!</strong> About Me have been updated successfully!
      </div>


<script type="text/javascript">


// {{-- ==================================================== Edit About Me  ==================================================== --}}

$('.aboutMeSecButton').click(function(){

        $('.aboutMeSec').attr("contentEditable", "true");
        $('.aboutMeSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
        $('.aboutMeSec').addClass('editable');
        $('.saveAboutMeButton').removeClass('d-none');
});

$(".saveAboutMeButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var aboutMe = $('.aboutMeSec').text();
    console.log(aboutMe);
    $('.AboutMeLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/Mabout_me',
        data: {'aboutMe': aboutMe},
        success: function(resp){
            if(resp.status){
                $('.AboutMeLoader').hide();
                $('.saveAboutMeButton').addClass('d-none');
                $('.aboutMeSec').attr("contentEditable", "false");
                $('.aboutMeSec').removeClass('interestedInEditColor').css("border","none");
                $('.AboutMeAlert').show().delay(3000).fadeOut('slow');

            }
        }
    });
});



</script>