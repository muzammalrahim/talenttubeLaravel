{{-- @extends('site.user.usertemplate') --}}
@extends('site.user.usermaster')

@section('custom_css')
<style>
    .js_location {
    font-size: 11px !important;
    }
    div#tabs_profile>ul.tab.customTab {
    margin-bottom: 15px;
    }

</style>
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Job Seeker Detail</div>

    {{-- @dump($employers) --}}
    <div class="add_new_job">
        <div class="job_row_heading jobs_filter">

            @php
                $js = $jobSeeker;
            @endphp


            <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">
                <div class="jobSeeker_box relative dinline_block w100">
                <div class="js_profile w_30p w_box dblock fl_left">
                    <div class="js_profile_cont center p10">
                        @php
                        $profile_image   = asset('images/site/icons/nophoto.jpg');
                        if ($js->profileImage){
                            $profile_image = asset('images/user/'.$js->id.'/gallery/'.$js->profileImage->image);
                        }
                        @endphp
                        <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
                    </div>
                    <div class="js_info center">
                        <div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>
                        {{-- <div class="js_status_label">{{$js->statusText}}</div> --}}
                        <div class="js_location">Location: {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}} </div>
                    </div>
                </div>

                <div class="js_info w_70p w_box dblock fl_left">
                    <div class="js_interested js_field">
                        <span class="js_label">Recent Job:</span>
                        <p>{{$js->recentJob}}</p>
                    </div>
                    <div class="js_about js_field">
                        <span class="js_label">About me:</span>
                        <p class="js_about_me"> {{$js->about_me}}</p>
                    </div>
                    <div class="js_interested js_field">
                        <span class="js_label">Interested in:</span>
                        <p>{{$js->interested_in}}</p>
                    </div>
                    <div class="js_interested js_field">
                        <span class="js_label">Expected Salary:</span>
                        <p>{{$js->salaryRange}}</p>
                    </div>

                    <div class="js_education js_field">
                        <span class="js_label">Qualification:</span>
                        <div class="qualifType"><i class="fas fa-angle-right qualifiCationBullet"></i>Type:
                            <span class="qualifTypeSpan">{{$js->qualificationType}}</span>
                        </div>
                        {{-- {{implode(', ', getQualificationNames($js->qualification))}} --}}
                     @php
                          $qualificationsData =  ($js->qualification)?(getQualificationsData($js->qualification)):(array());
                      @endphp
                        @if(!empty($qualificationsData))
                           @foreach($qualificationsData as $qualification)
                              <div class="QualificationSelect">
                                  <p style="margin-bottom: 0px;"><i class="fas fa-angle-double-right qualifiCationBullet"></i>{{$qualification['title']}}</p>
                              </div>
                           @endforeach
                         @endif 
                    </div>
                    
                    <div class="js_interested js_field">
                        <span class="js_label">Industry Experience:</span>
                            @if(isset($js->industry_experience))
                            @foreach ($js->industry_experience as $ind)
                                <div class="indsutrySelect">
                                 <p style="margin-bottom: 0px;"><i class="fas fa-angle-right qualifiCationBullet"></i>{{getIndustryName($ind)}} </p>
                                </div>
                            @endforeach
                            @endif
                    </div>

                </div>

                <div class="js_actionBtn">
                    <a class="jsBlockUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
                    @if (in_array($js->id,$likeUsers))
                    <a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
                    @else
                    <a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
                    @endif
                </div>
                </div>
            </div>

        </div>
    </div>

<div class="cl"></div>


<!-- tabs_employer -->
<div class="tabs_profile tabContainer">

  

    <div id="tabs_profile">
        <ul class="tab customTab">
            {{-- <li id="tabs-1_switch" class="switch_tab ">
                <a href="#tabs-1" title=""><span>Jobs</span></a>
            </li> --}}

            <li id="tabs-2_switch" class="switch_tab selected">
                <a href="#tabs-2" title=""><span>Albums</span></a>
            </li>

            <li id="tabs-3_switch" class="switch_tab">
                <a href="#tabs-3" title=""><span>Questions</span></a>
            </li>

           {{--  <li id="tabs-3_switch" class="switch_tab">
                <a href="#tabs-3" title=""><span>Questions</span></a>
            </li> --}}


        </ul>
    </div>

    

    <div id="tabs_content" class="tabs_content">

    <!-- tab_album -->
    <a id="tabs-2" class="tab_link tab_a target"></a>
    <div class="tab_photos tab_cont">

        <div class="galleryCont">
            <div class="head2">Gallery Photos</div>
            <div class="photos">
                @if ($galleries)
                @foreach ($galleries as $gallery)
                    <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{asset('images/user/'.$jobSeeker->id.'/gallery/'.$gallery->image)}}"
                            data-lcl-thumb="{{asset('images/user/'.$jobSeeker->id.'/gallery/small/'.$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="w100"
                            data-src="{{asset('images/user/'.$jobSeeker->id.'/gallery/'.$gallery->image)}}"
                            src="{{asset('images/user/'.$jobSeeker->id.'/gallery/small/'.$gallery->image)}}" >
                        </a>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
        <!-- /photos -->

        <div class="cl mb20"></div>

        <div class="VideoCont">
            <div class="head2">Gallery Videos</div>
            <div class="videos">
                @if ($videos->count() > 0 )
                @foreach ($videos as $video)
                    <div id="v_{{$video->id}}" class="video_box">
                        <a class="video_link" href="{{asset('images/user/'.$video->file)}}" data-lcl-thumb="{{'images/user/'.asset($video->file)}}" target="_blank">
                        <span class="v_title">{{$video->title}}</span>
                        </a>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
        <!-- /videos -->

    </div>



    <!-- /tab_album -->


   <!--Tab Questions -->     
    <a id="tabs-3" class="tab_link tab_a"></a>
    <div class="tab_photos tab_cont">

            {{-- Added By Hassan --}}

            @php  
                $userQuestions = !empty($js->questions)?(json_decode($js->questions, true)):(array()); 
            @endphp
            {{-- @dump($userQuestions) --}}
            @if(!empty(getUserRegisterQuestions()))
            @foreach (getUserRegisterQuestions() as $qk => $empq)

                {{($empq)}}
                    <b><p>
                        @if(!empty($userQuestions[$qk]))

                         {{$userQuestions[$qk]}}
                        @elseif(empty($userQuestions[$qk]))
                            {{'Not Answered'}}
                        @endif
                    </p></b>
            @endforeach
            @endif
    </div>


{{-- Added By Hassan --}}
<!--Tab Questions end here -->     


    </div>



</div>
<!-- /tabs_employer -->








</div>



<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Block Job Seeker?</div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_JobSeekerBlock_ok btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
        <div class="apiMessage"></div>
    </div>
</div>
</div>



 

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {

 // ========== Function to show Block popup when click on ==========//
 $(document).on('click','.jsBlockUserBtn',function(){
     var jobseeker_id = $(this).data('jsid');
     console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
     $('#jobSeekerBlockId').val(jobseeker_id);
     $('#confirmJobSeekerBlockModal').modal({
        fadeDuration: 200,
        fadeDelay: 2.5,
        escapeClose: false,
        clickClose: false,
    });
 });

 // ========== Block Employer Ajax call  ==========//
 $(document).on('click','.confirm_JobSeekerBlock_ok',function(){
    console.log(' confirm_JobSeekerBlock_ok ');
    var jobseeker_id = $('#jobSeekerBlockId').val();

    $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
    var btn = $(this); //
    btn.prop('disabled',true);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/blockJobSeeker/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                $('.confirmJobSeekerBlockModal .img_chat').html(data.message);
                $('.jobSeeker_row.js_'+jobseeker_id).remove();
            }else{
                $('.confirmJobSeekerBlockModal .img_chat').html(data.error);
            }
        }
    });
});

// ========== Ajax call to like the employer ==========//
$(document).on('click','.jsLikeUserBtn',function(){
    var btn = $(this);
    var jobseeker_id = $(this).data('jsid');
    console.log(' jsLikeUserBtn jobseeker_id ', jobseeker_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    $(this).html('..');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/likeJobSeeker/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                btn.html('Liked').addClass('active');
                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
            }else{
                btn.html('error');
            }
        }
    });
});



 // ========== Function to show popup when click on jobApplyBtn ==========//
//  $('#jobApplyModal').on($.modal.OPEN, function(event, modal) {
//     var job_id = $('#openModalJobId').val();
//     console.log(' job_id ', job_id);
//     console.log(' after open ', event);
//     $.ajax({
//     type: 'GET',
//         url: base_url+'/ajax/jobApplyInfo/'+job_id,
//         success: function(data){
//             $('#jobApplyModal .cont').html(data);
//         }
//     });
// });


// $('.jobApplyBtn').on('click',function(){
//     var job_id = $(this).attr('data-jobid');
//     $('#openModalJobId').val(job_id);
//     $('#jobApplyModal .cont').html(getLoader('css_loader loader_edit_popup'));
//     $('#jobApplyModal').modal({
//         fadeDuration: 200,
//         fadeDelay: 2.5
//     });
// });

//========== jobApplyBtn clck end. ==========


// ========== Function to submit job application ==========//
// $(document).on('click','.submitApplication',function(){
//     event.preventDefault();
//     // var job_id = $(this).attr('data-jobid');
//     console.log(' submitApplication submit click ');
//     $('.submitApplication').html(getLoader('jobSubmitBtn')).prop('disabled',true);

//     var applyFormData = $('#job_apply_form').serializeArray()
//     $.ajax({
//     type: 'POST',
//         url: base_url+'/ajax/jobApplySubmit',
//         data: applyFormData,
//         success: function(data){
//             $('.submitApplication').html('Submit').prop('disabled',false);
//             console.log(' data ', data );
//             if (data.status == 1){
//                  $('#job_apply_form').html(data.message);
//             }else {
//                  $('#job_apply_form').html(data.error);
//             }



//         }
//     });
// });
//========== jobSubmitApplyBtn clck end. ==========

});
</script>
@stop

{{-- @extends('site.user.usertemplate') --}}
@extends('site.user.usermaster')

@section('custom_css')
<style>
    .js_location {
    font-size: 11px !important;
}
</style>
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Job Seeker Detail</div>

    {{-- @dump($employers) --}}
    <div class="add_new_job">
        <div class="job_row_heading jobs_filter">

            @php
                $js = $jobSeeker;
            @endphp


            <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">
                <div class="jobSeeker_box relative dinline_block w100">
                <div class="js_profile w_30p w_box dblock fl_left">
                    <div class="js_profile_cont center p10">
                        @php
                        $profile_image   = asset('images/site/icons/nophoto.jpg');
                        if ($js->profileImage){
                            $profile_image = asset('images/user/'.$js->id.'/gallery/'.$js->profileImage->image);
                        }
                        @endphp
                        <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
                    </div>
                    <div class="js_info center">
                        <div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>
                        {{-- <div class="js_status_label">{{$js->statusText}}</div> --}}
                        <div class="js_location">Location: {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}} </div>
                    </div>
                </div>

                <div class="js_info w_70p w_box dblock fl_left">

                    <div class="js_interested js_field">
                        <span class="js_label">Recent Job:</span>
                        <p>{{$js->recentJob}}</p>
                    </div>

                    

                    <div class="js_about js_field">
                        <span class="js_label">About me:</span>
                        <p class="js_about_me"> {{$js->about_me}}</p>
                    </div>

                    <div class="js_interested js_field">
                        <span class="js_label">Interested in:</span>
                        <p>{{$js->interested_in}}</p>
                    </div>

                    <div class="js_education js_field">
                        <span class="js_label">Qualification:</span>{{implode(', ',getQualificationNames($js->qualification))}}
                    </div>

                    <div class="js_interested js_field">
                        <span class="js_label">Industry Experience:</span>
                            @if(isset($js->industry_experience))
                            @foreach ($js->industry_experience as $ind)
                                 <p>{{getIndustryName($ind)}} </p>
                            @endforeach
                            @endif
                    </div>

                    <div class="js_interested js_field">
                        <span class="js_label">Expected Salary:</span>
                        <p>{{$js->salaryRange}}</p>
                    </div>
                        {{-- @dump($jobSeeker) --}}
                </div>

                <div class="js_actionBtn">
                    <a class="jsBlockUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
                    @if (in_array($js->id,$likeUsers))
                    <a class="active graybtn jbtn" data-jsid="{{$js->id}}">Liked</a>
                    @else
                    <a class="jsLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">Like</a>
                    @endif
                </div>
                </div>
            
            </div>
        </div>
    </div>

<div class="cl"></div>


<!-- tabs_employer -->
<div class="tabs_profile tabContainer">
    <div id="tabs_profile">
        <ul class="tab customTab">
            {{-- <li id="tabs-1_switch" class="switch_tab ">
                <a href="#tabs-1" title=""><span>Jobs</span></a>
            </li> --}}

            <li id="tabs-2_switch" class="switch_tab selected">
                <a href="#tabs-2" title=""><span>Albums</span></a>
            </li>
        </ul>
    </div>

    <div id="tabs_content" class="tabs_content">

    


    <!-- tab_album -->
    <a id="tabs-2" class="tab_link tab_a target"></a>
    <div class="tab_photos tab_cont">

        <div class="galleryCont">
            <div class="head2">Gallery Photos</div>
            <div class="photos">
                @if ($galleries)
                @foreach ($galleries as $gallery)
                    <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}}">
                        <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{asset('images/user/'.$jobSeeker->id.'/gallery/'.$gallery->image)}}"
                            data-lcl-thumb="{{asset('images/user/'.$jobSeeker->id.'/gallery/small/'.$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="w100"
                            data-src="{{asset('images/user/'.$jobSeeker->id.'/gallery/'.$gallery->image)}}"
                            src="{{asset('images/user/'.$jobSeeker->id.'/gallery/small/'.$gallery->image)}}" >
                        </a>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
        <!-- /photos -->

        <div class="cl mb20"></div>

        <div class="VideoCont">
            <div class="head2">Gallery Videos</div>
            <div class="videos">
                @if ($videos->count() > 0 )
                @foreach ($videos as $video)
                    <div id="v_{{$video->id}}" class="video_box">
                        <a class="video_link" href="{{asset('images/user/'.$video->file)}}" data-lcl-thumb="{{'images/user/'.asset($video->file)}}" target="_blank">
                        <span class="v_title">{{$video->title}}</span>
                        </a>
                    </div>
                @endforeach
            @endif
            </div>
        </div>
        <!-- /videos -->

    </div>
    <!-- /tab_album -->


    </div>
</div>
<!-- /tabs_employer -->








</div>



<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Block Job Seeker?</div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirm_JobSeekerBlock_ok btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
        <div class="apiMessage"></div>
    </div>
</div>
</div>



 

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {

 // ========== Function to show Block popup when click on ==========//
 $(document).on('click','.jsBlockUserBtn',function(){
     var jobseeker_id = $(this).data('jsid');
     console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
     $('#jobSeekerBlockId').val(jobseeker_id);
     $('#confirmJobSeekerBlockModal').modal({
        fadeDuration: 200,
        fadeDelay: 2.5,
        escapeClose: false,
        clickClose: false,
    });
 });

 // ========== Block Employer Ajax call  ==========//
 $(document).on('click','.confirm_JobSeekerBlock_ok',function(){
    console.log(' confirm_JobSeekerBlock_ok ');
    var jobseeker_id = $('#jobSeekerBlockId').val();

    $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
    var btn = $(this); //
    btn.prop('disabled',true);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/blockJobSeeker/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                $('.confirmJobSeekerBlockModal .img_chat').html(data.message);
                $('.jobSeeker_row.js_'+jobseeker_id).remove();
            }else{
                $('.confirmJobSeekerBlockModal .img_chat').html(data.error);
            }
        }
    });
});

// ========== Ajax call to like the employer ==========//
$(document).on('click','.jsLikeUserBtn',function(){
    var btn = $(this);
    var jobseeker_id = $(this).data('jsid');
    console.log(' jsLikeUserBtn jobseeker_id ', jobseeker_id);
    // $(this).html(getLoader('blockJobSeekerLoader'));
    $(this).html('..');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/likeJobSeeker/'+jobseeker_id,
        success: function(data){
            btn.prop('disabled',false);
            if( data.status == 1 ){
                btn.html('Liked').addClass('active');
                // $('.jobSeeker_row.js_'+jobseeker_id).remove();
            }else{
                btn.html('error');
            }
        }
    });
});



 // ========== Function to show popup when click on jobApplyBtn ==========//
//  $('#jobApplyModal').on($.modal.OPEN, function(event, modal) {
//     var job_id = $('#openModalJobId').val();
//     console.log(' job_id ', job_id);
//     console.log(' after open ', event);
//     $.ajax({
//     type: 'GET',
//         url: base_url+'/ajax/jobApplyInfo/'+job_id,
//         success: function(data){
//             $('#jobApplyModal .cont').html(data);
//         }
//     });
// });


// $('.jobApplyBtn').on('click',function(){
//     var job_id = $(this).attr('data-jobid');
//     $('#openModalJobId').val(job_id);
//     $('#jobApplyModal .cont').html(getLoader('css_loader loader_edit_popup'));
//     $('#jobApplyModal').modal({
//         fadeDuration: 200,
//         fadeDelay: 2.5
//     });
// });

//========== jobApplyBtn clck end. ==========


// ========== Function to submit job application ==========//
// $(document).on('click','.submitApplication',function(){
//     event.preventDefault();
//     // var job_id = $(this).attr('data-jobid');
//     console.log(' submitApplication submit click ');
//     $('.submitApplication').html(getLoader('jobSubmitBtn')).prop('disabled',true);

//     var applyFormData = $('#job_apply_form').serializeArray()
//     $.ajax({
//     type: 'POST',
//         url: base_url+'/ajax/jobApplySubmit',
//         data: applyFormData,
//         success: function(data){
//             $('.submitApplication').html('Submit').prop('disabled',false);
//             console.log(' data ', data );
//             if (data.status == 1){
//                  $('#job_apply_form').html(data.message);
//             }else {
//                  $('#job_apply_form').html(data.error);
//             }



//         }
//     });
// });
//========== jobSubmitApplyBtn clck end. ==========

});
</script>
@stop

