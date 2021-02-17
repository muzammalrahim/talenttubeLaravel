{{-- @extends('site.user.usertemplate') --}}
@extends('mobile.user.usermaster')
@section('content')



<div class="card shadow mb-3 bg-white rounded">

  <h6 class="card-header h6 m-0">Personal Information {{-- <i class="fas fa-edit float-right"></i> --}} </h6>

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

            <div class="avatarimg">
            <img src="{{$profile_image}}"
                alt="avatar mx-auto white" class="rounded-circle img-fluid" style="height: 110px">
            </div>
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
      <strong>Success!</strong> Interested In updated successfully!
    </div>

    {{-- =============================================== Recent Job =============================================== --}}
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
    
    {{-- =============================================== Salary Range =============================================== --}}


    <div class="salarySection"><b>Expecting Salary: </b>

      <div class="spinner-border spinner-border-sm text-primary salaryLoader ml-2" role="status" style="display:none;"></div>
      <i class="fas fa-edit float-right salarySecButton"></i> 
      <p class="oldSalary my-1"> <b>{{'AUD: '}}</b><span  class="salaryRangeValue">{{number_format($user->salaryRange),3}}</span>  </p>
    </div>

    <div class="newSalary my-2 d-none">
      {{ Form::select('salaryRange', $salaryRange, $user->salaryRange, 
      ['placeholder' => 'Select Salary Range', 'id' => 'salaryRangeFieldnew',  'class' => 'form-control custom-select']) }}
    </div>

     <div class="alert alert-success salaryAlert" role="alert" style="display:none;">
      <strong>Success!</strong> Salary updated successfully!
    </div>

    {{-- =============================================== About Me =============================================== --}}

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
  <li class="nav-item">
    <a class="nav-link" id="reference-tab-just" data-toggle="tab" href="#reference-just" role="tab" aria-controls="reference-just"
      aria-selected="false">Reference</a>
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
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery js-smartPhoto2" data-group="no-gravity"
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
  {{-- =================================================================== Photos Delete Modal =================================================================== --}}

  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">

  <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h5 class="modal-title" id="exampleModalLongTitle">Are you sure to delete the picture?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="UProfile.deleteGallery(); return false;">Yes</button>
         <input type="hidden" name="deleteConfirmId" id="deleteConfirmId" value=""/>
      </div>
    </div>
  </div>
</div>



{{-- Resume & Contact Detail --}}

<div class="prvate-section text-dark mt-2">

    <div class="tabs_resume mb-2 font-weight-bold"> <i class="fa fa-lock" aria-hidden="true"></i> Resume &amp; Contact Details</div>
    <ul class="list_interest_c" style="margin: 0;padding: 0 0 0 23px;">
        <li><span id="info_looking_for_orientation">Email: {{$user->email}}</span></li>
        <li><span id="info_looking_for_ages">Mobile : {{$user->phone}}</span></li>
        {{-- <li> <a class="btn violet view-resume" target="_blank" style="" href="/talenttube/_files/resumeUpload/3687_Pimmys logo.pdf">View Resume</a></li> --}}
    </ul>
    <form id="frm_upload" class="submit-document1" action="" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
        <br>
        {{-- <div class="row">  --}}
          <input type="file" name="resume" id="resume" class="form-control" accept=".pdf,.doc,.docx">
          <button class="btn btn-sm btn-primary save-resume-btn" name="" style="padding: 5px;">Upload Resume</button>
        {{-- </div> --}}
    </form>
</div>

<div class="private_attachments">
      @foreach ($attachments as $attachment)
      <div class="attachment_{{$attachment->id}} attachment_file">
        <div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" height="70px" /></div>
        <span class="attach_title">{{ $attachment->name }}</span>
        <div class="attach_btns">
          <a class="attach_btn btn btn-sm btn-primary d-inline-block" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
          <a class="attach_btn btn btn-sm btn-danger removeAttachBtn d-inline-block" data-attachmentid="{{$attachment->id}}" data-toggle="modal" data-target="#deleteResumeModal">Remove</a>
        </div>
      </div>
      @endforeach
    </div>


{{-- Delete Resume Modal --}}



 <!-- Central Modal Medium Danger -->
 <div class="modal fade" id="deleteResumeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Delete Resume</p>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
            <p> This action can not be undone. Are you sure you wish to continue? </p>
         </div>
       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">No</a>
         <input type="hidden" name="" class="deleteAttachmentIdInModal">
         <a type="button" class="btn btn-danger confirmDeleteAttachment" data-dismiss="modal" >Yes </a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Danger-->


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
            <div class="videos mt-2">
                @if ($videos->count() > 0 )
                @foreach ($videos as $video)
                    <div id="v_{{$video->id}}" class="video_box mb-2">
              <div class="modal fade" id="modal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body mb-0 p-0">
                      <div class="embed-responsive embed-responsive-16by9 z-depth-1-half videoBox">
                          <video id="player" playsinline controls data-poster="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg">
                            <source src="{{assetVideo($video)}}" type="video/mp4" />
                          </video>

                      </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <a>
                  {!! generateVideoThumbsm($video) !!}
                </a>
                    </div>
                @endforeach
            @endif
         </div>
        </div>
    </div>
  {{-- =================================================================== videos end =================================================================== --}}

  </div>



  {{-- ============================================================= Album Tab Ends here ============================================================= --}}


  {{-- ============================================================= Questions Tab Start here ============================================================= --}}


    <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
        <div class="mb-3 bg-white rounded text-dark">
            <h6 class="card-header h6">Questions <div class="spinner-border spinner-border-sm text-light userQuesLoader ml-2" role="status" style="display:none;"></div>
            <i class="fas fa-edit float-right editQuestions"></i></h6>
            <div class="card-body p-2 cardBody">
                    <p class="loader SaveQuestionsLoader"style="float: left;"></p>
                      <div class="cl"></div>
                        <div class="questionsOfUser">
                          @include('mobile.layout.parts.jobSeekerQuestions')  {{--  mobile/layout/parts/jobSeekerQuestions    --}}
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <a class="btn btn-sm btn-success saveQuestionsButton d-none">Save</a>
                        </div>
                    <div class="alert alert-success questionsAlert" role="alert" style="display:none;">
                      <strong>Success!</strong> Questions have been updated successfully!
                    </div>
            </div>
        </div>

    </div>


  {{-- ============================================================= Reference Tab Start here ============================================================= --}}


    <div class="tab-pane fade" id="reference-just" role="tabpanel" aria-labelledby="reference-tab-just">
        <div class="mb-3 bg-white rounded text-dark">
          @include('mobile.layout.parts.jsAddReference')  {{--  mobile/layout/parts/jsAddReference    --}}
        </div>
    </div>

  {{-- ============================================================= Reference Tab End here ============================================================= --}}


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

.qualifType{ /*margin-left: 10px;*/font-size: 12px;}
.qualifTypeSpan{text-transform: capitalize;font-weight: bold;}
p,span{font-size: 12px;}
.iconPosition {position: relative;right: 20px;top: 5px;}
.tabs_profile .tab_photos .item {position: relative;overflow: hidden;width: 126px;height: 140px;margin: 0 26px 25px 0;transition: 0.5s ease;float: left;width: auto;
  height: auto;float: none;display: inline-block;box-shadow: 0 2px 4px -1px rgba(0,0,0,.2), 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12);border-radius: 4px;}
div#home-just {/*display: grid;*/}
.uploadedPhotos {vertical-align: middle;/* overflow: visible; */object-fit: cover;height: 119px;width: 120px;}
.teal.lighten-2 {background-color: #254c8e !important;}
</style>
@stop

@section('custom_js')
<link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
<script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.js"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mobile/userProfile.js') }}"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script>
    @if ($videos->count() > 0 )
    @foreach ($videos as $video)

    $('#modal{{$video->id}}').on('hidden.bs.modal', function (e) {
  // do something...
        var src = $(this).find(".videoBox video").find("source").attr('src');
        $(this).find(".videoBox video").find("source").attr('src');
        var videoElem  = '<video id="player" controls>';
        videoElem     += '<source src="'+src+'" type="video/mp4">';
        videoElem     += '</video>';
        $(this).find(".videoBox video").remove();
        $(this).find(".videoBox").html(videoElem);
    });
    @endforeach
    @endif

</script>
<script type="text/javascript">


document.addEventListener('DOMContentLoaded',function(){

new SmartPhoto(".js-smartPhoto2",{
        useOrientationApi: false
});
});


(function ($) {
  $.fn.progressBar = function (givenValue) {
    const $this = $(this);

    function init(selector) {
      const progressValue = selector.children().attr('aria-valuenow');
      selector.children().width(progressValue + "%");
      selector.children().html('<span></span>');
      $this.hasClass('md-progress') ? selector.children().children().addClass('md-progress-bar-text') : selector.children().children().addClass('progress-bar-text');
      (progressValue != 100) ? selector.children().children().text(progressValue + "%") : selector.children().children().html('<i class="fas fa-check"></i>');
    }

    function set(selector, value) {
      selector.children().removeClass('success fail active');
      selector.children().attr('aria-valuenow', value);
      init(selector);
      if (value > 100) {
        console.log('value over 100');
      } else if (value == 100) {
        selector.children().addClass('success');
      } else if (value < 30) {
        selector.children().addClass('fail');
      } else {
        selector.children().addClass('active');
      }
    }

    set($this, givenValue);
  }
}(jQuery));





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
    video_item  +=  '<span class="v_title"></span>';
    video_item  +=  '<span title="Delete video" class="icon_delete">';
    video_item  +=      '<span class="icon_delete_photo"></span>';
    video_item  +=      '<span class="icon_delete_photo_hover"></span>';
    video_item  +=  '</span>';
    video_item  +=  '<div class="v_error error hide_it"></div>';
    video_item  +=  '<div class="v_progress"></div>';
    video_item  += '</div>';
    // var video_item = '';
    video_item += '<div id="bar8" class="progress md-progress my-4">';
    video_item += '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">';
    video_item += '</div>';
    video_item += '</div>';
    $('.list_videos').append(video_item);
    $('#bar8').progressBar(0);
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
        $('#bar8').progressBar(percent);
    }, false);
    request.addEventListener('load', function(e){
        console.log(' load e ', e);
        var resp = JSON.parse(e.target.responseText);
        console.log(' jsonResponse ', resp);
        $('#v_'+item_id+' .v_progress').remove();
       $( "#bar8" ).remove();
        if (resp.status == 1) {
            $('#v_'+item_id).replaceWith(resp.html);
            $('#modal'+resp.data.id).on('hidden.bs.modal', function (e) {
            // do something...
                var src = $(this).find(".videoBox video").find("source").attr('src');
                $(this).find(".videoBox video").find("source").attr('src');
                var videoElem  = '<video id="player" controls>';
                videoElem     += '<source src="'+src+'" type="video/mp4">';
                videoElem     += '</video>';
                $(this).find(".videoBox video").remove();
                $(this).find(".videoBox").html(videoElem);
            });
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




// {{-- ==================================================== Edit Recent Job ==================================================== --}}

$('.recentJobSecButton').click(function(){

        $('.recentJobSec').attr("contentEditable", "true");
        $('.recentJobSec').addClass('interestedInEditColor').css("border","2px solid #dc9f4a");
        $('.recentJobSec').addClass('editable');
    $('.saveRecentJobButton').removeClass('d-none');


});

$(".saveRecentJobButton").click(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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

// ========================================================= Edit Salary Range =========================================================

$('.salarySecButton').click(function(){
  $('.oldSalary').addClass('d-none');
  $('.newSalary').removeClass('d-none');
});

$(document).on('change' , '#salaryRangeFieldnew' , function(){

  var salaryRangeField = $('#salaryRangeFieldnew option:selected').val();
  console.log(salaryRangeField);
  $('.salaryLoader').show(); 

    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({

        type: 'POST',
        url: base_url+'/m/ajax/MupdateSalaryRange',
        data: {'salaryRange': salaryRangeField},
        success: function(data){
          if(data.status == 1){
            $('.salaryLoader').hide(); 
            // $('.salaryRangeField').addClass('hide_it');
            $('.salaryAlert').show().delay(3000).fadeOut('slow');
            $('.oldSalary').removeClass('d-none');
            $('.newSalary').addClass('d-none');
            $('.salaryRangeValue').text(salaryRangeField);

          }
        }

      });

});


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


                    if(data.status==1){
                         $(".questionsOfUser").html(data.data);
                        // $(".SaveQuestionsSpinner").remove();

                }
            }
        });
    });

//  ======================================= User Questions Ajax End  =======================================

//================================================ User Questions Editing end here ================================================

$('.submit-document1').on('submit',(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append('submit', true);
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type:'POST',
    url: base_url+'/m/ajax/userUploadResume',
    data:formData,
    cache:false,
    contentType: false,
    processData: false,
    beforeSend:function(){
      $('.save-resume-btn').html('Saving... <i class="fa fa-spinner fa-spin"></i>');
    },
    success:function(data){
      $('.save-resume-btn').html('Upload Resume');
      if(data && data.attachments) {
      // data = JSON.parse(data);
      // $('.view-resume').attr('href', '/talenttube/_files/resumeUpload/'+data['attachment']).show();
      var attachments = data.attachments;
      console.log(attachments);
      var attach_html = '';
      attach_html += '<div class="attachment_'+attachments.id+' attachment_file">';
      attach_html +=   '<div class="attachment"><img src="'+base_url+'/images/site/icons/cv.png" height ="70px"/></div>';
      attach_html +=   '<span class="attach_title">'+attachments.name+'</span>';
      attach_html +=   '<div class="attach_btns">';
      attach_html +=      '<a class="attach_btn btn btn-sm btn-primary downloadAttachBtn" href="'+data.file+'">Download</a>';
      attach_html +=      '<a class="attach_btn btn btn-sm btn-danger removeAttachBtn" data-attachmentid="'+attachments.id+'" onclick="UProfile.confirmAttachmentDelete('+attachments.id+');">Remvoe</a>';
      attach_html +=    '</div>';
      attach_html +=  '</div>';
      $('.private_attachments').append(attach_html);
    }
    console.log(data);
  },
  error: function(data){
    console.log("error");
    console.log(data);
  }
});

}));


$('.removeAttachBtn').click(function(){
  var deleteAttachmentId = $(this).attr('data-attachmentid');
   $('.deleteAttachmentIdInModal').val(deleteAttachmentId);
});

$('.confirmDeleteAttachment').click(function(){
  var attachment_id = $('.deleteAttachmentIdInModal').val();
    console.log(attachment_id);
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  $.ajax({
    type:'GET',
    url: base_url+'/m/ajax/MremoveAttachment/',
    data: {attachment_id: attachment_id},
    success: function(data){
      console.log(' data ', data);
      if(data.status == 1){
        $('.attachment_file.attachment_'+attachment_id).remove();
      }
    }
  });

});




</script>


@stop
