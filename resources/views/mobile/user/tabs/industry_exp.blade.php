
<div class="card shadow mb-3 bg-white rounded">

  	<h6 class="card-header h6">Industry Experience <div class="spinner-border spinner-border-sm text-light indusExpLoader ml-2" role="status" style="display:none;">
  				{{-- <span class="sr-only">Loading...</span> --}}</div>

	<i class="fas fa-edit float-right editIndustry"></i></h6>

	<div class="card-body p-2 cardBody">
		<div class="title IndusListBox">

		  {{-- <div id="basic_anchor_industry_experience">Industry Experience <i class="editIndustry fas fa-edit "></i>
		  <p class="loader SaveIndustryLoader"style="float: left;"></p></div>
		  <div class="cl"></div> --}}
		      <p class="loader SaveindustryExperience"style="float: left;"></p>
		        <div class="cl"></div>
			        <div class="IndusList">
			         	@if(!empty($user->industry_experience))
						    @foreach($user->industry_experience as  $industry )
						    	<div class="IndustrySelect">
						              <input type="hidden" name="industry_experience[]" class="industry_experience" value="{{$industry}}">
						              <p class="mb-1">
                                        <i class="fas fa-angle-right mr-2"></i>
						              	{{getIndustryName($industry)}}
						              	<i class="fa fa-trash removeIndustry float-right hide_it2 float-right"></i></p>
						        </div>
						    @endforeach
						@endif
			        </div>
		            <span class="addIndus btn btn-sm btn-primary hide_it2"style = "cursor:pointer;">Add New</span>
		            <a class="btn btn-sm btn-success hide_it2 saveIndus buttonSaveIndustry"style = "cursor:pointer;">Save</a>
		</div>

		  <div class="alert alert-success IndusAlert" role="alert" style="display:none;">
		    <strong>Success!</strong> Industry Experience have been updated successfully!
		  </div>

	</div>

</div>


<script type="text/javascript">

//===================================================== add remove industry ===================================================

 $(".editIndustry").click(function(){
    $(this).closest('.IndusListBox').addClass('edit');

    $('.removeIndustry').removeClass('hide_it2');
    $('.addIndus').removeClass('hide_it2');
    $('.buttonSaveIndustry').removeClass('hide_it2');

    // console.log('welcome');
  });

// add and remove Industry code
$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

   $(document).on('click','.addIndus', function(){
    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect"><select name="industry_experience[]" class="industry_experience userIndustryExperience">';
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif
    newIndusHtml += '</select>';
    newIndusHtml += '<i class="fa fa-trash removeIndustry"></i>';
    newIndusHtml += '</div>';

    $('.IndusList').append(newIndusHtml);
   });
});

// ======================== Edit Industry Experience for Ajax ========================

$(".saveIndus").click(function(){
	// console.log('hi industry');
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var industry_experience = jQuery('.industry_experience').map(function(){ return $(this).val()}).get();

         // $('.indusExpLoader').after(getLoader('smallSpinner indusExpLoader'));
        $('.indusExpLoader').show();           //indusExpLoader


        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateIndustryExperience',
            data: {'industry_experience': industry_experience},
            // $('.IndusAlert').hide();


            success: function(resp){
                if(resp.status){
                  // $('.IndusListBox').removeClass('edit');
                  $('.IndusAlert').show().delay(3000).fadeOut('slow');
                  // $('.SaveIndustrySpinner').remove();

                  $('.IndusList').html(resp.data);
                  $('.removeIndustry').addClass('hide_it2');
			            $('.addIndus').addClass('hide_it2');
			            $('.buttonSaveIndustry').addClass('hide_it2');
                  $('.indusExpLoader').hide();


                    }
            }
    });
 });

// ======================================= Edit Industry Experience For Ajax End Here =======================================


//===================================================== add remove industry end  =====================================================

</script>
