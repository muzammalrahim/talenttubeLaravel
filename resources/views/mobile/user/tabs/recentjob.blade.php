<div class="recentJobSection"><b>Recent Job: </b>
     <div class="spinner-border spinner-border-sm text-primary recentJobLoader ml-2" role="status" style="display:none;"></div>
     <i class="fas fa-edit float-right recentJobSecButton"></i> <p class="recentJobSec">{{$user->recentJob}}</p>
</div>

<div class="col-md-12 text-center my-2">
	<a class="btn btn-sm btn-success saveRecentJobButton d-none">Save</a>
</div>

<div class="alert alert-success recentJobAlert" role="alert" style="display:none;">
	<strong>Success!</strong> Recent job updated successfully!
</div>


<script type="text/javascript">

// {{-- ==================================================== Edit Recent Job ==================================================== --}}

$('.recentJobSecButton').click(function(){
	$('.recentJobSec').attr("contentEditable", "true");
  	$('.recentJobSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
  	$('.recentJobSec').addClass('editable');
  	$('.saveRecentJobButton').removeClass('d-none');
});

$(".saveRecentJobButton").click(function(){
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    var recentJob = $('.recentJobSec').text();
    console.log(recentJob);
    $('.recentJobLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MupdateRecentJob',
        data: {'recentJob': recentJob},
        success: function(resp){
            if(resp.status){
                $('.recentJobLoader').hide();
                $('.saveRecentJobButton').addClass('d-none');
                $('.recentJobSec').attr("contentEditable", "false");
                $('.recentJobSec').removeClass('interestedInEditColor').css("border","none");
                $('.recentJobAlert').show().delay(3000).fadeOut('slow');


            }
        }
    });
});


</script>