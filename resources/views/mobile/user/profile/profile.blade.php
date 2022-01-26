{{-- @extends('site.user.usertemplate') --}}
@extends('web.user.usermaster')
@section('content')


<div class="tab-content" id="nav-tabContent">
   
   <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <section class="row">
         <div class="col-md-4 order-md-2 order-sm-1 profile-data-info ">
            <div class="profile-information ">
               <div class="profile-img-wrapper">
                  <div class="profileimgContainer">
                    <img  src="{{$profile_image}}" class="profile_img" width="150" height="200" alt="profile">
                  </div>
               </div>
               <div class="profile-detail clearfix ">
                  <div class="text-center">
                     <h1> {{ $user->name }} {{ $user->surname }} </h1>
                     {{-- <p> {{userLocation($user)}} </p> --}}

                     <div class="location p-2">  
                        <div class="row m-0"> 
                           <p class="userLocationSpan col-10" > {{userLocation($user)}} </p> 
                           <button type="button" id="list_info_location" class="orange_btn float-right col-2" onclick="showMap()">
                           <i class="fas fa-edit salaryRangeEdit"></i> 
                        </div>
                        </button>
                          <div class="location_search_cont hide_it ">
                              <div class="location_input dtable w100">
                                <input type="text" name="location_search" class="inp fl_left form-control" id="location_search" value="{{userLocation($user)}}" placeholder="Type a location" aria-invalid="false">
                                <select class="dinline_block filter_location_radius select_aw hide_it" name="filter_location_radius" data-placeholder="Select Location Radius">
                                     <option value="5">5km</option>
                                     <option value="10">10km</option>
                                     <option value="25">25km</option>
                                     <option value="50">50km</option>
                                     <option value="51">50km +</option>
                                </select>
                              </div>
                            <div class="location_latlong dtable w100">
                                <input type="hidden" class="location_lat w50 fl_left" name="location_lat" id="location_lat" value="" placeholder="Lat" readonly="true" aria-invalid="false">
                                <input type="hidden" class="location_long w50 fl_left" name="location_long" id="location_long" value="" placeholder="Long" readonly="true" aria-invalid="false">
                                <input type="hidden" name="location_name" id="location_name"  value="">
                                <input type="hidden" name="location_city" id="location_city"  value="">
                                <input type="hidden" name="location_state" id="location_state"  value="">
                                <input type="hidden" name="location_country" id="location_country"  value="">
                            </div>

                            <div class="location_map_box dtable w100"><div class="location_map" id="location_map"></div></div>
                            <div class="searchField_action">
                                <div class="searchFieldLabel dinline_block"></div>

                                {{-- <button class=" btn-sm btn-danger" onclick="showMap()">Cancel</button> --}}

                                <button class="btn small orange_btn saveNewLocation" onclick="updateLocation()">Save</button>

                            </div>
                        </div>
                     </div>

                     <h2> {{$user->username}} </h2>
                  </div>

                  
                  {{-- ==================================== Recent job ==================================== --}}

                     {{-- <div class="about-infomation">
                        <h2>Recent Job</h2>
                            <button type="button"  onclick="showFieldEditor('recentJob');" class="edited-text"><i class="fas fa-edit"></i></button>
                        
                        <div class="recentjob">
                           <span class="recentjobSpan"> {{$user->recentJob}} </span>
                              <b class="mx-2">at</b>
                           <span class="organizationSpan"> {{$user->organHeldTitle}} </span>
                        </div>

                        <div class="row sec_recentJob d-none">
                           <div class="col-5">
                              <input type="text" name="recentJobField" class="form-control recentJobField" value="{{$user->recentJob}}">
                           </div>
                           <div class="col-1">  <span> at </span>  </div>
                           <div class="col-6">
                              <input type="text" name="organHeldTitleField" class="form-control organHeldTitleField" value="{{$user->organHeldTitle}}" onclick="showFieldEditor()">
                           </div>
                        </div>           

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_recentJob d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('recentJob');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateRecentJob()">Save</button> 
                              </div>
                           </div>
                        </div>

                        <div class="alert alert-success alert_recentJob hide_me" role="alert">
                          <strong>Success!</strong> Recent Job has been updated successfully!
                        </div>
                     </div> --}}

                  {{-- ==================================== Recent job ==================================== --}}

                  <div class="recent-job recentjob clearfix px-3">

                     {{-- <div class="row m-0">  --}}
                        {{-- <div class="col-5"> --}}
                           <div class="d-inline-block">
                              <label class="mb-2">Recent Job:</label>
                        {{-- </div> --}}

                        {{-- <div class="col-7"> --}}
                              <span class="recentjobSpan"> {{$user->recentJob}} </span>
                              at
                              <span class="organizationSpan"> {{$user->organHeldTitle}} </span>
                              </div>
                        {{-- </div> --}}
                     {{-- </div> --}}

                  </div> 


                  {{-- ========================================= Salary Range ========================================= --}}


                  <div class="recent-job clearfix px-3">
                     {{-- <div class="row m-0"> --}}
                        <div class="d-inline-block">
                        {{-- <div class="col-5"> --}}
                           <label class="mb-2"> 
                              Expecting Salary: 
                           </label>
                        {{-- </div> --}}
                        {{-- <div class="col-7"> --}}
                           <span>AUD: </span>  <span class="salaryRangeValue"> {{number_format($user->salaryRange),3}} </span>
                        </div>
                        {{-- </div> --}}
                     {{-- </div> --}}
                  </div>


                  {{-- ========================================= Salary Range End Here ========================================= --}}
                  <div class="text-center mb-4">  
                     <button type="button" class="edit-btn orange_btn" data-toggle = "modal" data-target ="#multifieldPopUp" onclick="editMultipleFields()"><i class="fas fa-edit"></i>Edit</button>
                  </div> 
               </div>


            </div>
         </div>

         <div class="col-md-8 order-md-1 order-sm-2 first-tap-detail">

            <div class="profile profile-section">
               <ul class="nav nav-tabs" id="Profile-tab" role="tablist">
                  <span class="line-tab"></span>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">
                     <i class="fa fa-circle tab-circle-cross"></i>Profile</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="profile-tab1" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Album</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Questions</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="tag-tab" data-bs-toggle="tab" data-bs-target="#tag"
                        type="button" role="tab" aria-controls="tag" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Tags</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="job-tab" data-bs-toggle="tab" data-bs-target="#job"
                        type="button" role="tab" aria-controls="job" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Job</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="refrance-tab" data-bs-toggle="tab" data-bs-target="#refrance"
                        type="button" role="tab" aria-controls="refrance" aria-selected="false">
                     <i class="fa fa-circle tab-circle-cross"></i>Refrences</button>
                  </li>

               </ul>
               <div class="tab-content" id="myTabContent">
                  <!--==================== profile tab-->
                  <div class="profile-text-wrap tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Profile-tab">
                     
                     

                     {{-- ==================================== About me ==================================== --}}

                     <div class="about-infomation">
                        <h2>About me</h2>
                        <button type="button"id="showeditbox" onclick="showFieldEditor('about_me');" class="edited-text"><i class="fas fa-edit"></i></button>
                        <p class="text_about_me m-0"> {{$user->about_me}} </p>

                        <textarea class="form-control bg-white border-0 sec_about_me d-none" rows="3" cols="3" readonly > {{$user->about_me}}</textarea>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_about_me d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('about_me');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateProfile('about_me');" >Save</button> 
                              </div>
                           </div>
                        </div>
                        <div class="alert alert-success alert_about_me hide_me" role="alert">
                          <strong>Success!</strong> About me has been updated successfully!
                        </div>
                     </div>

                     <div class="about-infomation">
                        <h2>Interested In</h2>
                        <button type="button"  onclick="showFieldEditor('interested_in');" class="edited-text"><i class="fas fa-edit"></i></button>
                        
                        <p class="text_interested_in m-0"> {{$user->interested_in}} </p>

                        <textarea class="form-control bg-white border-0 sec_interested_in d-none" rows="3" cols="3" readonly > {{$user->interested_in}}</textarea>

                        <div class="row">
                           <div class="col-md-12">
                              <div class="float-right button_interested_in d-none">
                                 <button class="cancel-button" onclick="hideFieldEditor('interested_in');">Cancel</button>
                                 <button class="orange_btn mt-2" onclick="updateProfile('interested_in');">Save</button> 
                              </div>
                           </div>
                        </div>
                        <div class="alert alert-success alert_interested_in hide_me" role="alert">
                          <strong>Success!</strong> Interested In have been updated successfully!
                        </div>
                     </div>


                    
                    <div class="about-infomation bl qualificationBox">
                        <h2>Qualification</h2>
                        <button type="button" class="edited-text" onclick="showQualificationEditor();"><i class="fas fa-edit editQualification"></i></button>
                        <p class="loader SaveQualification"style="float: left;"></p>
                              <div class="cl"></div>
                        <ul class="qualification-li">
                            <li><i class="qualification-circle"></i><span> Type: {{ ucfirst($user->qualificationType) }}</span></li>
                            <div class="">
                            @include('site.layout.parts.jobSeekerQualificationList') {{-- site/layout/parts/jobSeekerQualificationList --}}  </div>
                            <div class="button_qualification d-none "> 
                                <button class="btn-info btn-block rounded py-2 btn-sm m-0 addQualification" onclick="addQualification()" >Add New</button> 
                                 <button class="savequalification btn-block orange_btn rounded py-2 " onclick="updateQualification()">Save</button>
                              </div>
                              <div class="alert alert-success QualifAlert hide_me" role="alert">
                                <strong>Success!</strong> Qualification have been updated successfully!
                              </div>
                        </ul>
                     </div> 
                    

                    <div class="about-infomation IndusListBox">
                        <h2>Industry Experience</h2>
                        <button type="button" class="edited-text" onclick="showIndustryExpEditor();"><i class="fas fa-edit"></i></button>
                        <ul class="qualification-li font-16">
                            <div class="IndusList">  
                              @include('site.layout.parts.jobSeekerIndustryList')
                            </div>
                            <div class="button_industryExperience d-none">
                                <button class="addIndus btn-info btn-block rounded py-2 btn-sm m-0" onclick="addIndustryExp()" >Add New</button> 
                                <button class=" btn-block orange_btn rounded py-2  saveIndus " onclick="updateIndusExperience()">Save</button>
                            </div>
                            <div class="alert alert-success IndusAlert hide_me" role="alert">
                               <strong>Success!</strong> Industry Experience have been updated successfully!
                            </div>
                        </ul>
                    </div>
                </div>
               
                  <!-- ========================================== album-tab ========================================== -->
                  

                  <div class="album-section tab-pane fade Photos " id="profile" role="tabpanel" aria-labelledby="profile-tab">

                     @include('site.user.profile.tabs.album')  {{-- site/user/profile/tabs/album --}}
                     

                     @include('web.user.profile.tabs.resume')  {{-- web/user/profile/tabs/resume --}}

                     <div class=" Gallery">
                        <h2>Video's</h2>

                           @include('web.user.profile.tabs.videos') {{-- web/user/profile/tabs/videos --}}

                     </div>
                  </div>


                  <!-- ========================================== question tab ========================================== -->
                  
                  <div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">

                     <h2>Questions  <button type="button"  onclick="showFieldEditor('question');" class="edited-text orange_btn float-right"><i class="fas fa-edit"></i></button></h2>
                     
                        @include('site.user.profile.questionsuserpart')
                  </div>

                  <!-- ========================================== tag tab ========================================== -->
                  <div class="tab-pane fade tag-tab-info " id="tag"  role="tabpanel" aria-labelledby="tag-tab">

                     @include('site.user.profile.tabs.tags')

                  </div>
                  <!--=================job tab ============================ -->
                  
                  <div class="tab-pane fade job-applied" id="job"  role="tabpanel" aria-labelledby="job-tab">

                     @include('site.user.profile.tabs.jobs') {{-- site/user/profile/tabs/jobs --}}

                  </div>
                  
                  <!--=================referancesss tab=====================-->
                  <div class="tab-pane fade referance-tab" id="refrance"  role="tabpanel" aria-labelledby="refrance-tab">
                     @include('site.user.profile.tabs.reference') {{-- site/user/profile/tabs/reference --}}
                  </div>

                  <!--========================end all tabs-->
               </div>
               
               </div>

            </div>
 
      </section>
   </div>
   
</div>


<div class="bj-modal">
   <div class="modal fade" id="multifieldPopUp" tabindex="-1" role="dialog"
      aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog filter-industry-modal" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <div class="m-header">
                  <h4 class="modal-title" id="myModalLabel">
                     <img src="{{ asset('assests/images/filter.png') }}" alt="img" class="">
                     Edit Fields
                  </h4>
                  <i data-dismiss="modal" aria-label="Close" class="close-box fa fa-times"></i>
               </div>
            </div>
            <div class="modal-body">

               <div class="i-modal-checks multiFields">
                  
               </div>


            </div>
            <div class="modal-footer" >
               <button type="button" class="btn btn-primary bs-btn" data-dismiss="modal">
               {{-- <img src="{{ asset('assests/images/search-modal.png') }}" alt="img" class=""> --}}
               <span class="fb-text"> Done </span>
               </button>
            </div>
         </div>
      </div>
   </div>
</div>




{{-- ======================================================================================================================== --}}

@stop


@section('custom_footer_css')
<style type="text/css">


</style>
@stop

@section('custom_js')
<link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
<script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.js"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/mobile/userProfile.js') }}"></script>
<script src="{{ asset('js/site/plyr.polyfilled.js') }}"></script>
<script src="{{ asset('js/web/profile.js') }}"></script>

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


    // {{-- ==================================================== Edit Qualification ==================================================== --}}

  this.addQualification = function(){
    console.log('Add Qualification Button profile');

    var newQualificationHtml = '<div class="QualificationSelect row ml-0 my-2"> <select name="qualification[]" class="userQualification form-control col-10">';
    @if(!empty($qualificationList))
        @foreach($qualificationList as $lk=>$qualification)
            newQualificationHtml += '<option value="{{$qualification['id']}}">{{$qualification['title']}}</option>';
        @endforeach
    @endif
    newQualificationHtml += '</select>';
    newQualificationHtml += '<div class = "col-2">';
    newQualificationHtml += '<i class="fa fa-trash removeQualification float-right"></i></div>';
    newQualificationHtml += '</div>';
    newQualificationHtml += '</div>';
    $('.jobSeekerQualificationList').append(newQualificationHtml);

  }


// ===================================================== add remove industry ===================================================


$(document).ready(function(){
   $(document).on('click','.removeIndustry', function(){
    $(this).closest('.IndustrySelect').remove();
   });

    this.addIndustryExp = function (){

    console.log(' addIndus ');
    var newIndusHtml = '<div class="IndustrySelect row ml-0 my-2"><select name="industry_experience[]" class="industry_experience userIndustryExperience form-control col-10">';
    @if(!empty($industriesList))
        @foreach($industriesList as $lk=>$lv)
            newIndusHtml += '<option value="{{$lk}}">{{$lv}}</option>';
        @endforeach
    @endif
    newIndusHtml += '</select>';
    newIndusHtml += '<div class = "col-2">';
    newIndusHtml += '<i class="fa fa-trash removeIndustry float-right"></i></div>';
    newIndusHtml += '</div>';
    $('.IndusList').append(newIndusHtml);

   }

});

// ======================== Edit Industry Experience for Ajax ========================

var toggle = true;
$('input[name="filter_location_status"]').change(function() {
    console.log(' filter_location_status ');
    (this.checked)?(jQuery('.location_search_cont').removeClass('hide_it')):(jQuery('.location_search_cont').addClass('hide_it'));
});

function showMap(){
    if(toggle){
        jQuery('.location_search_cont').removeClass('hide_it');
        toggle = false;
    }
    else{
        jQuery('.location_search_cont').addClass('hide_it');
        toggle = true;
    }
}



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



</script>


@stop
