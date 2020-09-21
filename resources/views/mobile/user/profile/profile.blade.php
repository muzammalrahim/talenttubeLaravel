{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')



<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6">Personal Information {{-- <i class="fas fa-edit float-right"></i> --}} </h6>

	  <div class="card-body p-2 cardBody">


{{-- ==================================================== For image ==================================================== --}}


<!--Section: Testimonials v.1-->
{{-- <section class="section pb-3 text-center"> --}}
  <!--Section description-->

  <div class="row">

    <!--Grid column-->
    <div class="col-lg-12 col-md-12 mb-1">

      <!--Card-->
      <div class="testimonial-card">
        <!--Background color-->
        <div class="card-up teal lighten-2">
        </div>
        <!--Avatar-->
        <div class="avatar mx-auto white">
          <img src="{{$profile_image}}"
            alt="avatar mx-auto white" class="rounded-circle img-fluid">
        </div>

      </div>
      <!--Card-->

    </div>
    <!--Grid column-->
  </div>

{{-- </section> --}}
<!--Section: Testimonials v.1-->



{{-- ==================================================== For image ==================================================== --}}
		{{-- <div id="over" style="/*position:absolute; */width:auto; height:150px"> --}}
        {{-- @dump($profile_image) --}}

           {{--  <a class="show_photo_gallery" href="{{$profile_image}}" data-lcl-thumb="{{$profile_image}}" >
            <img  class="photo" id="pic_main_img" src="{{$profile_image}}" title="">
            </a> --}}

	



            {{-- <div class="personalInfoDiv"> --}}
        		<div class="personalInfo mt-2"> <h6 class="m-0 font-weight-bold">{{$user->name}} {{$user->surname}}</h6></div>
        		<div class="personalInfo"> <b>Email:</b>     <span class="m-0">{{$user->email}}</span></div>
        		<div class="personalInfo"> <b>Phone:</b>     <span class="m-0">{{$user->phone}}</span></div>
        		<div class="personalInfo"> <b>Location: </b> <span class="m-0 mb-1">{{userLocation($user)}}</span></div>
            {{-- </div> --}}

		<div class="aboutMeSection"><b>Interested In: </b>
            <div class="spinner-border spinner-border-sm text-primary IntsdInLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right intInSecButton"></i> <p class="interestedInSec">{{$user->interested_in}}</p>
        </div>

		<div class="col-md-12 text-center my-2">
                              <a class="btn btn-sm btn-success saveInterestedInButton d-none">Save</a>
        </div>

        <div class="alert alert-success interestedInAlert" role="alert" style="display:none;">
          <strong>Success!</strong> Interested In have been updated successfully!
        </div>

        {{-- Interested In --}}

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

		    <div class="cardContent"></div>
		    <div class="cardEdit" style="display: none;"></div>
		{{-- @dump($user); --}}

	  </div>
  </div>
</div>

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

		        	{{-- @php
					  $qualificationsData =  ($user->qualification)?(getQualificationsData($user->qualification)):(array());
					@endphp
					@if(!empty($qualificationsData))
					   @foreach($qualificationsData as $qualification)
					      <div class="QualificationSelect">
					          <input type="hidden" name="qualification[]" class="userQualification" value="{{$qualification['id']}}">
					          <p>{{$qualification['title']}} <i class="fa fa-trash removeQualification hide_it2 float-right"></i></p>
					      </div>
					   @endforeach
					 @endif  --}}

                    @include('mobile.layout.parts.jobSeekerQualificationList')
                    {{-- mobile/layout/parts/jobSeekerQualificationList --}}

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



{{-- ======================================================================================================================== --}}


<ul class="nav nav-tabs nav-justified md-tabs indigo" id="myTabJust" role="tablist" style="font-size:12px">

  <li class="nav-item">
    <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"
      aria-selected="true">Albums</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just"
      aria-selected="false">Questions</a>
  </li>

{{--   <li class="nav-item">
    <a class="nav-link" id="tags-tab-just" data-toggle="tab" href="#tags-just" role="tab" aria-controls="tags-just"
      aria-selected="false">Tags</a>
  </li> --}}

</ul>

<div class="tab-content card pt-5 pl-2 text-dark" id="myTabContentJust">


  {{-- ============================================================= Album Tab Start here ============================================================= --}}

    <div class="tab-pane fade show active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">

  {{-- =================================================================== Photos =================================================================== --}}

    <div class="tabs_photos text-dark mb-2 font-weight-bold">Photos</div>
        <div class="list_photos_public d-flex">
            <div class="list_photos_trans">
            <div id="photo_add_public" class="item add_photo add_photo_public">
                <a href="#null" class="dblock uploadProgressModalBtn"><img src="{{asset('/images/site/icons/add_photo126x140.png')}}" alt="" class="bg-primary float-left mr-3 ml-1 mt-2 uploadedPhotos" ></a>
            </div>
            @if ($user_gallery)
                @foreach ($user_gallery as $gallery)
                    <div id="{{$gallery->id}}" class="float-left mt-1 item profile_photo_frame gallery_{{$gallery->id}} {{($gallery->access == 2)?'private':'public'}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            data-lcl-thumb="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="photo m-1 uploadedPhotos"
                            data-src="{{assetGallery($gallery->access,$user->id,'',$gallery->image)}}"
                            src="{{assetGallery($gallery->access,$user->id,'small',$gallery->image)}}"{{--  alt="thumbnail" class="img-thumbnail"
  style="width: 150px;height:150px;" --}}>
                        </a>
                        <div class="gallery_action float-right">
                            {{-- <i class="fas fa-user"></i> --}}
                                <span onclick="UProfile.confirmPhotoDelete({{$gallery->id}});" title="Delete photo" class="icon_delete">
                                    {{-- <span class="icon_delete_photo"></span> --}}
                                    <div class="iconPosition"><i class="fas fa-trash"></i></div>
                                    <span class="icon_delete_photo_hover"></span>
                                </span>
                                <span onclick="UProfile.setPrivateAccess({{$gallery->id}})"  title="Make private" class="icon_private">
                                    {{-- <span class="icon_private_photo"></span> --}}
                                    <div class="iconPosition"><i class="fas fa-lock"></i></div>

                                    <span class="icon_private_photo_hover"></span>
                                </span>
                                <span onclick="UProfile.setAsProfile({{$gallery->id}})" title="Make Profile" class="icon_image_profile">
                                        {{-- <span class=""></span> --}}
                                    <div class="iconPosition"><i class="fas fa-user"></i></div>

                                </span>
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
  {{-- =================================================================== Photos end =================================================================== --}}



      {{-- =================================================================== videos =================================================================== --}}

    <div class="video text-dark mt-3">
    <div class="tabs_videos mb-2 font-weight-bold">Videos</div>
        <div id="video" class="list_videos">
            <div id="list_videos_public" class="list_videos_public">
                <div id="photo_add_video" class="item add_photo add_video_public item_video">
                    <a class="add_photo" onclick="UProfile.SelectVideoFile(); return false;">
                        <img id="video_upload_select" class="transparent is_video bg-primary uploadedPhotos" onload="$(this).fadeTo(100,1);" src="{{asset('images/site/icons/add_video160x120.png')}}" style="opacity: 1;">
                    </a>
                </div>
            </div>
            <div class="cl"></div>

            @if ($videos->count() > 0 )
                @foreach ($videos as $video)
                    <div id="v_{{$video->id}}" class="item profile_photo_frame item_video" style="display: inline-block;">
                        <a onclick="UProfile.showVideoModal('{{$video->file}}')" class="video_link" target="_blank">
                            <div class="v_title_shadow"><span class="v_title">{{$video->title}}</span></div>
                           {!! generateVideoThumbs($video) !!}
                        </a>
                        <span title="Delete video" class="icon_delete" data-vid="{{$video->id}}" onclick="UProfile.delteVideo({{$video->id}})">
                            <span class="icon_delete_photo"></span>
                            <span class="icon_delete_photo_hover"></span>
                        </span>

                        <div class="v_error error hide_it"></div>
                    </div>
                @endforeach
            @endif

            <div class="list_videos"></div>
            <div style="display:none;">
                <div id="videoShowModal" class="modal p0 videoShowModal">
                    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
                        <div class="cont">
                            <div class="videoBox"></div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
  {{-- =================================================================== videos end =================================================================== --}}

  </div>



  {{-- ============================================================= Album Tab Ends here ============================================================= --}}


    <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">



        <div class="mb-3 bg-white rounded text-dark">

            <h6 class="card-header h6">Questions <div class="spinner-border spinner-border-sm text-light userQuesLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right editQuestions"></i></h6>

            <div class="card-body p-2 cardBody">

                    <p class="loader SaveQuestionsLoader"style="float: left;"></p>
                      <div class="cl"></div>

                        <div class="questionsOfUser">
                          @include('mobile.layout.parts.jobSeekerQuestions')  {{--  mobile/layout/parts/jobSeekerQuestions    --}}

                                <div class="col-md-12 text-center mt-3">
                                    <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                                </div>
                        </div>

                    <div class="alert alert-success questionsAlert" role="alert" style="display:none;">
                      <strong>Success!</strong> Questions have been updated successfully!
                    </div>
            </div>

        </div>



    </div>

{{--   <div class="tab-pane fade" id="contact-just" role="tabpanel" aria-labelledby="contact-tab-just">
    <p class="text-dark">Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro
      fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone
      skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings
      gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork
      biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl
      craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
  </div> --}}

{{--   <div class="tab-pane fade" id="tags-just" role="tabpanel" aria-labelledby="tags-tab-just">
    <p class="text-dark">Come here Later</p>
  </div> --}}

</div>


{{-- ======================================================================================================================== --}}

@stop


@section('custom_footer_css')
<style type="text/css">


.qualifType{
    /*margin-left: 10px;*/
    font-size: 12px;
}
.qualifTypeSpan{
    text-transform: capitalize;
    font-weight: bold;
}
p,span{
    font-size: 12px;
}

.iconPosition {
    position: relative;
        right: 20px;
    top: 5px;
}

.tabs_profile .tab_photos .item {
    position: relative;
    overflow: hidden;
    width: 126px;
    height: 140px;
    margin: 0 26px 25px 0;
    transition: 0.5s ease;
    float: left;
    width: auto;
    height: auto;
    float: none;
    display: inline-block;
    box-shadow: 0 2px 4px -1px rgba(0,0,0,.2), 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12);
    border-radius: 4px;
}
div#home-just {
    /*display: grid;*/
}
.uploadedPhotos {
    vertical-align: middle;
    /* overflow: visible; */
    object-fit: cover;
    height: 119px;
    width: 120px;
}
.teal.lighten-2 {
    background-color: #254c8e !important;
}

</style>
@stop

@section('custom_js')
<link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
<script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.js"></script>
{{-- <script src="{{ asset('js/mobile/jobSeekerProfile.js') }}"></script> --}}

<script type="text/javascript">


document.addEventListener('DOMContentLoaded',function(){

new SmartPhoto(".js-smartPhoto2",{
        useOrientationApi: false
});
});



$('#photo_add_video').on('click', function(){

var input = document.createElement('input');
input.type = 'file';
input.onchange = e => {
    var file = e.target.files[0];
    console.log(' onchange file  ', file);
    var formData = new FormData();
    formData.append('video', file);
    var item_id = Math.floor((Math.random() * 1000) + 1);
    var video_item = '';
    video_item += '<div id="v_'+item_id+'" class="item profile_photo_frame item_video" style="display: inline-block;">';
    video_item  +=  '<a class="show_photo_gallery video_link" href="">';
    video_item  +=  '</a>';
    video_item  +=  '<span class="v_title">Video title</span>';
    video_item  +=  '<span title="Delete video" class="icon_delete">';
    video_item  +=      '<span class="icon_delete_photo"></span>';
    video_item  +=      '<span class="icon_delete_photo_hover"></span>';
    video_item  +=  '</span>';
    video_item  +=  '<div class="v_error error hide_it"></div>';
    video_item  +=  '<div class="v_progress"></div>';
    video_item  += '</div>';
    $('.list_videos').append(video_item);
    var updateForm = document.querySelector('form');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var request = new XMLHttpRequest();
    request.upload.addEventListener('progress', function(e){
        var percent = Math.round((e.loaded / e.total) * 100);
        console.log(' progress-bar ', percent+'%' );
        $('#v_'+item_id+' .v_progress').css('width', percent+'%');
    }, false);
    request.addEventListener('load', function(e){
        console.log(' load e ', e);
        var resp = JSON.parse(e.target.responseText);
        console.log(' jsonResponse ', resp);
        $('#v_'+item_id+' .v_progress').remove();
        if (resp.status == 1) {
            $('#v_'+item_id).replaceWith(resp.html);
        } else {
            console.log(' video error ');
            if (resp.validator != undefined) {
                $('#v_'+item_id+' .error').removeClass('hide_it').addClass('to_show').text(res.validator['video'][0]);
            }
        }
    }, false);
    request.open('post', base_url+'/m/ajax/uploadVideo');
    request.send(formData);
}
input.click();
});


$('.uploadProgressModalBtn').on('click', function() {

            var input = document.createElement('input');
			input.type = 'file';
			input.onchange = e => {
				var file = e.target.files[0];
				console.log(' onchange file  ', file );
                var formData = new FormData();
                console.log(formData);
                formData.append('file',file);
                var that = this;
                var item_id =  Math.floor((Math.random() * 1000) + 1);
                var gallery_item = '<div class="float-left mt-1 item profile_photo_frame photo_item_'+item_id+'" id="'+item_id+'">';
                gallery_item += '<a class="show_photo_gallery" style="opacity:0;">';
                gallery_item += '<img data-photo-id="'+item_id+'" class="photo" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"\>';
                gallery_item += '</a>';
                gallery_item += '<div class="gallery_action float-right">';
                gallery_item += '<span onclick="" title="Delete photo" class="icon_delete">';
                gallery_item += ' <div class="iconPosition"><i class="fas fa-trash"></i></div>';
                gallery_item += ' <span class="icon_delete_photo_hover"></span>';
                gallery_item += ' </span>';
                gallery_item += '<span onclick=""  title="Make private" class="icon_private">';
                gallery_item += '<div class="iconPosition"><i class="fas fa-lock"></i></div>';
                gallery_item += '<span class="icon_private_photo_hover"></span>';
                gallery_item += '</span>';
                gallery_item += '<span onclick="" title="Make Profile" class="icon_image_profile">';

                gallery_item += '<div class="iconPosition"><i class="fas fa-user"></i></div>';

                gallery_item += '</span>';
                gallery_item += '</div>';
                gallery_item += '</div>';
                $('.list_photos_trans').append(gallery_item);
                alert(base_url);
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
			    $.ajax({

			       url: base_url+'/m/ajax/uploadUserGallery',
			       type : 'POST',
			       data : formData,
			       processData: false,  // tell jQuery not to process the data
			       contentType: false,  // tell jQuery not to set contentType
			       success : function(resp) {

			           console.log('upload_chat_front resp ', resp);
			          if(resp.status == 1){
                       $('.photo_item_'+item_id).replaceWith(resp.html);
                            $('.photo_item_'+item_id).find('img').attr('src',resp.image);

					  }
			       }
			    });
			}
            input.click();
    });

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
        url: base_url+'/m/ajax/MupdateInterested_in',
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

// {{-- ==================================================== Edit Interested IN End ==================================================== --}}

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

// {{-- ==================================================== Edit About Me End ==================================================== --}}


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



//===================================================== User Questions Edit =====================================================

 $(".editQuestions").click(function(){
     $('.hideme').show();
     $('.saveQuestionsButton').removeClass('d-none');
     $('.QuestionsKeyPTag').addClass('d-none');
     $('.jobSeekerRegQuestion').removeClass('d-none');


});

//  ======================================= User Questions Ajax saveQuestionsButton =======================================

    $(".saveQuestionsButton").click(function(){
        var items = {};
        $('select.jobSeekerRegQuestion').each(function(index,el){
        // console.log(index, $(el).attr('name')  , $(el).val()   );
            // items.push({name:  $(el).attr('name') , value: $(el).val()});
            var elem_name = $(el).attr('name');
            var elem_val = $(el).val();
            items[elem_name] = elem_val;
            // items.push({elem_name : elem_val });
        $('.userQuesLoader').show();           //indusExpLoader

        });
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('.SaveQuestionsLoader').after(getLoader('smallSpinner SaveQuestionsSpinner'));
        $.ajax({
            type: 'POST',
            url: base_url+'/m/ajax/MupdateQuestions',
            data: {'questions': items},

            success: function(data){
                    $('.questionsAlert').show().delay(3000).fadeOut('slow');
                    $('.saveQuestionsButton').addClass('d-none');
                    $('.userQuesLoader').hide();
                    // location.reload();

                    $('.QuestionsKeyPTag').removeClass('d-none');
                    $('.jobSeekerRegQuestion').addClass('d-none');


                    if(data){
                        // $(".questionsOfUser").load(" .questionsOfUser");
                        // $(".SaveQuestionsSpinner").remove();

                }
            }
        });
    });

//  ======================================= User Questions Ajax End  =======================================

//================================================ User Questions Editing end here ================================================

</script>


@stop

