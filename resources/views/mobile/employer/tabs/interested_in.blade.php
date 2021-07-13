<div class="aboutMeSection"><b>Interested In: </b>
    <div class="spinner-border spinner-border-sm text-primary IntsdInLoader ml-2" role="status" style="display:none;"></div>
    <i class="fas fa-edit float-right intInSecButton"></i> <p class="interestedInSec">{{$user->interested_in}}</p>
</div>

<div class="col-md-12 text-center my-2"> <a class="btn btn-sm btn-success saveInterestedInButton d-none">Save</a> </div>

<div class="alert alert-success interestedInAlert" role="alert" style="display:none;">
  <strong>Success!</strong> Interested In have been updated successfully!
</div>





<script type="text/javascript">

// {{-- ==================================================== Edit Interested IN ==================================================== --}}

$('.intInSecButton').click(function(){

        $('.interestedInSec').attr("contentEditable", "true");
        $('.interestedInSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
        $('.interestedInSec').addClass('editable');
    $('.saveInterestedInButton').removeClass('d-none');


});

$(".saveInterestedInButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var interestedIn = $('.interestedInSec').text();
    console.log(interestedIn);
        $('.IntsdInLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MupdateInterested_inEmp',
        data: {'interestedIn': interestedIn},
        success: function(resp){
            if(resp.status){
                $('.IntsdInLoader').hide();
                $('.saveInterestedInButton').addClass('d-none');
                $('.interestedInSec').attr("contentEditable", "false");
                $('.interestedInSec').removeClass('interestedInEditColor').css("border","none");
                $('.interestedInAlert').show().delay(3000).fadeOut('slow');


            }
        }
    });
});

// {{-- =========================================== Edit Interested IN End =========================================== --}}


</script>