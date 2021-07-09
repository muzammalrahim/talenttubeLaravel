
<div class="card shadow mb-3 bg-white rounded">

	<h6 class="card-header h6">Qualification <div class="spinner-border spinner-border-sm text-light qualifExpLoader ml-2" role="status" style="display:none;"></div>
  <i class="fas fa-edit float-right editQualification"></i></h6>

	<div class="card-body p-2 cardBody">
	  	<div class="bl qualificationBox">
	    	<div class="title qualificationList">
	        	<p class="loader SaveQualification"style="float: left;"></p>
	        	<div class="cl"></div>

		        <div class="jobSeekerQualificationList">

              <div class="qualifType"><i class="fas fa-angle-right qualifiCationBullet mr-2"></i>
                  <span class="ml-1">Type:</span>
                      <span class="qualifTypeSpan">{{$user->qualificationType}}</span>
              </div>

              @include('mobile.layout.parts.jobSeekerQualificationList')

		        </div>
	    	</div>
		         <a class="addQualification btn btn-sm btn-primary text-white hide_it2"style = "cursor:pointer;">Add New</a>
		         <a class="qualificationSaveButton btn btn-sm btn-success hide_it2">Save</a>
		</div>

	    <div class="alert alert-success QualifAlert hide_it2" role="alert">
	        <strong>Success!</strong> Qualification have been updated successfully!
	    </div>
	</div>

</div>


<script type="text/javascript">

// {{-- ==================================================== Edit Qualification ==================================================== --}}


  $(document).ready(function(){

  $(".editQualification").click(function(){
        $(this).closest('.qualificationBox').addClass('editQualif');
        $('.removeQualification').removeClass('hide_it2');
        $('.addQualification').removeClass('hide_it2');
        $('.qualificationSaveButton').removeClass('hide_it2');
        // console.log('Testing Qualification');
  });

   $('.qualificationBox').on('click','.removeQualification', function(){
      console.log('removeQualification');
     $(this).closest('.QualificationSelect').remove();
   });

 })
   $(document).on('click','.addQualification', function(){
    console.log(' addQualification ');
    var newQualificationHtml = '<div class="QualificationSelect"><select name="qualification[]" class="userQualification">';
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>';
        @endforeach
    @endif
    newQualificationHtml += '</select>';
    newQualificationHtml += '<i class="fa fa-trash removeQualification"></i>';
    newQualificationHtml += '</div>';
    $('.jobSeekerQualificationList').append(newQualificationHtml);
   });



// ====================================================== Edit Qualification Ajax ======================================================

    $(".qualificationSaveButton").click(function(){
    	console.log('hi qualification');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var qualification = jQuery('.userQualification').map(function(){ return $(this).val()}).get();
        $('.qualifExpLoader').show();           //indusExpLoader
        // $('.SaveQualification').after(getLoader('smallSpinner SaveQualificationSpinner'));

        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateQualification',
            data: {'qualification': qualification},
            success: function(resp){
                if(resp.status){
                    $('.removeQualification ').addClass('hide_it2');
                    $('.addQualification').addClass('hide_it2');
                    $('.qualificationSaveButton').addClass('hide_it2');
                    $('.qualifExpLoader').hide();
                    $('.jobSeekerQualificationList').html(resp.data);

                    // location.reload();
                }
            }
        });
})


// ====================================================== End Qualification Ajax end here ======================================================

// ==================================================== Edit Qualification ====================================================

</script>