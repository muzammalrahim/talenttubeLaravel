
@if(isset($employers))
@if ($employers->count() > 0)
@foreach ($employers as $js)
<div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">

	<div class="jobSeeker_box relative dinline_block w100">
		<div class="js_profile w_30p w_box dblock fl_left">
			<div class="js_profile_cont center p10">
				@php
				$profile_image  = asset('images/site/icons/nophoto.jpg');
				$profile_image_gallery    = $js->profileImage()->first();
				// dump($profile_image_gallery);
				if ($profile_image_gallery) {
				// $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
					$profile_image   = assetGallery2($profile_image_gallery,'small');
					// dump($profile_image);
				}
				@endphp
				<img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
			</div>
			<div class="js_info center">
				<div class="js_name"><h4 class="bold">{{$js->name}} {{$js->company}}</h4></div>
				{{-- <div class="js_status_label">{{$js->statusText}}</div> --}}
			</div>

		</div>
		<div class="js_info w_70p w_box dblock fl_left">
			{{--   <div class="js_education js_field">
				<span class="js_label">Qualification:</span>{{implode(', ',getQualificationNames($js->qualification))}}
			</div> --}}

			{{-- ============================================= Pie Chart =============================================  --}}
			
			@include('site.user.match_algo.match_algo')
			
			{{-- ============================================= Pie Chart =============================================  --}}
        	

			<div class="js_about js_field">
				<span class="js_label">About me:</span>
				<p class="js_about_me"> {{$js->about_me}}</p>
			</div>
			<div class="js_interested js_field">
				<span class="js_label">Interested in:</span>
				<p>{{$js->interested_in}}</p>
			</div>
			<div class="js_location js_field"><span class="js_label">Location:</span>
				<p class="js_location"> {{$js->city}},  {{$js->state}}, {{$js->country}} </p>
			</div>

			<div class="js_interested js_field"> 
				<span class="js_label">Industry Experience:</span> 
				@if(isset($js->industry_experience))
				@foreach ($js->industry_experience as $ind) 
					 <div class="indsutrySelect"> <p style="margin-bottom: 0px;"><i class="fas fa-angle-right qualifiCationBullet"></i>{{getIndustryName($ind)}} </p> 
				 	</div> 
				@endforeach 
				@endif 
			</div>


		</div>
		{{-- @dump($likeUsers) --}}

		<div class="js_actionBtn">
			<a class="graybtn jbtn" href="{{route('employerInfo', ['id' => $js->id])}}">Detail</a>
			<a class="jsBlockUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
			@if (in_array($js->id,$likeUsers))
				<a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
			@else
				<a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
			@endif
		</div>
	</div>
</div>

@endforeach
<div class="jobseeker_pagination cpagination">{!! $employers->render() !!}</div>
@endif
@endif

<script type="text/javascript">


 // ========== Function to show Block popup when click on ==========//
 // $(document).ready(function(){
 // $(document).on('click','.jsBlockUserBtn',function(){
 //     var jobseeker_id = $(this).data('jsid');
 //     console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
 //     $('#jobSeekerBlockId').val(jobseeker_id);
 //     $('#confirmJobSeekerBlockModal').modal({
 //        fadeDuration: 200,
 //        fadeDelay: 2.5,
 //        escapeClose: false,
 //        clickClose: false,
 //    });
 // });

 // ========== Block Employer Ajax call  ==========//
//  $(document).on('click','.confirm_JobSeekerBlock_ok',function(){
//     console.log(' confirm_JobSeekerBlock_ok ');
//     var jobseeker_id = $('#jobSeekerBlockId').val();

//     $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
//     var btn = $(this); //
//     btn.prop('disabled',true);

//     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
//     $.ajax({
//         type: 'POST',
//         url: base_url+'/ajax/blockEmployer/'+jobseeker_id,
//         success: function(data){
//             btn.prop('disabled',false);
//             if( data.status == 1 ){
//                 $('.confirmJobSeekerBlockModal .img_chat').html(data.message);
//                 $('.jobSeeker_row.js_'+jobseeker_id).remove();
//             }else{
//                 $('.confirmJobSeekerBlockModal .img_chat').html(data.error);
//             }
//         }
//     });
// });
// });
</script>
