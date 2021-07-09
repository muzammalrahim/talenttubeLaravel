

<div class="organSection"><b>Organization Name: </b>
  <div class="spinner-border spinner-border-sm text-primary organLoader ml-2" role="status" style="display:none;"></div>
  <i class="fas fa-edit float-right organSecButton" onclick="edit_organization()"></i> <p class="organSec">{{$user->organHeldTitle}}</p>
</div>


<div class="col-md-12 text-center my-2">
  <a class="btn btn-sm btn-success saveorganButton d-none">Save</a>
</div>

<div class="alert alert-success organAlert" role="alert" style="display:none;">
  <strong>Success!</strong> Organization updated successfully!
</div>


<script type="text/javascript">
 
// ======================================================== Edit Organization ========================================================

this.edit_organization =  function(){
  console.log('edit organization held title');
  $('.organSec').attr("contentEditable", "true");
  $('.organSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
  $('.organSec').addClass('editable');
  $('.saveorganButton').removeClass('d-none');
}

$(".saveorganButton").click(function(){
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    var organization = $('.organSec').text();
    console.log(organization);
    $('.organLoader').show();
    $.ajax({
        type: 'POST',
        url: base_url+'/m/ajax/MupdateOrganization',
        data: {'organHeldTitle': organization},
        success: function(resp){
            if(resp.status){
                $('.organLoader').hide();
                $('.saveorganButton').addClass('d-none');
                $('.organSec').attr("contentEditable", "false");
                $('.organSec').removeClass('interestedInEditColor').css("border","none");
                $('.organAlert').show().delay(3000).fadeOut('slow');


            }
        }
    });
}); 



</script>