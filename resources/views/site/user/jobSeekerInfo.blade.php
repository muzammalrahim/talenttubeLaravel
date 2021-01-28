{{-- @extends('site.user.usertemplate') --}}


{{-- @if ($controlsession->count() > 0)
    <div class="adminControl">
            <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
    </div>
@endif

 --}}
@extends('site.user.usermaster')

@section('custom_css')

<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop




@section('content')

{{-- @dump($UserInterview); --}}
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Job Seeker Detail</div>
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
                       $profile_image  = asset('images/site/icons/nophoto.jpg');
                        $profile_image_gallery    = $js->profileImage()->first();
                        if ($profile_image_gallery) {
                            // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                            $profile_image   = assetGallery2($profile_image_gallery,'small');
                            // dump($profile_image);
                        }
                        @endphp
                        <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
                    </div>
                    <div class="js_info center">
                        <div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>
                        {{-- <div class="js_status_label">{{$js->statusText}}</div> --}}
                        <div class="js_location">Location: {{$js->city}},  {{$js->state}}, {{$js->country}} </div>
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
                    <a id="JSBlockBtn" class="graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
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

            <li id="tabs-4_switch" class="switch_tab">
                <a href="#tabs-4" title=""><span>Reference</span></a>
            </li>

            {{-- <li id="tabs-5_switch" class="switch_tab">
                <a href="#tabs-5" title=""><span>History</span></a>
            </li>

            <li id="tabs-6_switch" class="switch_tab">
                <a href="#tabs-6" title=""><span>Notes</span></a>
            </li> --}}

            {{-- @dump($user->id); --}}
            @if ($controlsession->count() > 0 || isAdmin())
                @include('site.user.jobseekerInfoTabs.notesAndHistory')
            @endif

            <li id="tabs-7_switch" class="switch_tab">
                <a href="#tabs-7" title=""><span>Interview</span></a>
            </li>

           {{--  <li id="tabs-3_switch" class="switch_tab">
                <a href="#tabs-3" title=""><span>Questions</span></a>
            </li> --}}

        </ul>
    </div>

    <div id="tabs_content" class="tabs_content">

    <!-- tab_album -->

    <!-- =============================================== Tab Albums =============================================== -->

    <a id="tabs-2" class="tab_link tab_a target"></a>
    <div class="tab_photos tab_cont">
        <div class="galleryCont">
            <div class="head2">Gallery Photos</div>
                <div class="photos">
                    @if ($galleries)
                    @foreach ($galleries as $gallery)
                        <div id="{{$gallery->id}}" class="emp_profile_photo_frame fl_left gallery_{{$gallery->id}}">
                            <a  data-offset-id="{{$gallery->id}}" class="show_photo_gallery"
                            href="{{assetGallery($gallery->access,$jobSeeker->id,'',$gallery->image)}}"

                            data-lcl-thumb="{{assetGallery($gallery->access,$jobSeeker->id,'small',$gallery->image)}}"
                            >
                            <img data-photo-id="{{$gallery->id}}"  id="photo_{{$gallery->id}}"   class="w100"
                            data-src="{{assetGallery($gallery->access,$jobSeeker->id,'',$gallery->image)}}"
                            src="{{assetGallery($gallery->access,$jobSeeker->id,'small',$gallery->image)}}" >
                            </a>
                        </div>
                    @endforeach
                    @endif
                </div>
        </div>

        <div class="cl mb20"></div>
        @if($isallowed)
        {{-- private area --}}
            <span class="prvate-section">
                <div class="title_private_photos" style="margin-bottom: 5px;">
                    Resume &amp; Contact Details
                </div>
                <ul class="list_interest_c" style="margin: 0;padding: 0 0 0 23px;">
                    <li><span class="basic_info">•</span><span id="info_looking_for_orientation">Email: {{$js->email}}</span></li>
                    <li><span class="basic_info">•</span><span id="info_looking_for_ages">Mobile : {{$js->phone}}</span></li>
                    {{-- <li> <a class="btn violet view-resume" target="_blank" style="" href="/talenttube/_files/resumeUpload/3687_Pimmys logo.pdf">View Resume</a></li> --}}
                </ul>
            </span>
                <br>
                <div class="private_attachments">
                    @foreach ($attachments as $attachment)
                        {{-- {{asset('images/user/'.$attachment->file)}} --}}
                        <div class="attachment_{{$attachment->id}} attachment_file">
                            <div class="attachment"><img src="{{asset('images/site/icons/cv.png')}}" /></div>
                            <span class="attach_title">{{ $attachment->name }}</span>
                            <div class="attach_btns">
                                    <a class="attach_btn downloadAttachBtn" href="{{asset('images/user/'.$attachment->file)}}">Download</a>
                            </div>
                        </div>
                    @endforeach
            </div>
            @else
            <span class="prvate-section">
                <div class="title_private_photos" style="margin-bottom: 5px;">
                    Content Locked
                </div>
                <div class="attach_btns">
                    <a class="attach_btn downloadAttachBtn"  onclick="UProfile.confirmPurchase({{$js->id}});" style="margin-bottom: 25px;">Unlock</a>
                </div>
            </span>
        @endif
        <div class="cl mb20"></div>
        <div class="VideoCont">
            <div class="head2">Gallery Videos</div>
            <div class="videos">
                @if ($videos->count() > 0 )
               	@foreach ($videos as $video)
                <div id="v_{{$video->id}}" class="item profile_photo_frame item_video" style="display: inline-block;">
                    <a onclick="UProfile.showVideoModal('{{assetVideo($video)}}')" class="video_link" target="_blank">
                        <div class="v_title_shadow"><span class="v_title">{{$video->title}}</span></div>
                            {!! generateVideoThumbs($video) !!}
                        </a>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <!-- /videos -->
    </div>

    <div style="display:none;">
        <div id="lowPointsModal" class="modal p0 confirmDeleteModal">
            <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
                <div class="cont">
                    <div class="title">You don't have enough credits</div>
                    <div class="img_chat">
                        <div class="icon">
                                <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                        </div>
                        <div class="msg">Please, purchases some points to unlock private info</div>
                    </div>
                    <div class="double_btn">
                        <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">OK</button>
                        <input type="hidden" name="user_id" id="user_id" value=""/>
                        <div class="cl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Hi there --}}


    <div style="display:none;">
        <div id="confirmPurchaseModal" class="modal p0 confirmDeleteModal">
            <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
                <div class="cont">
                    <div class="title">Do you wanna unlock this user private info? costs 10 points</div>
                    <div class="img_chat">
                            <div class="icon">
                                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                            </div>
                            <div class="msg">This action can not be undone. Are you sure you wish to continue?</div>
                    </div>
                    <div class="double_btn">
                            <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                            <button class="confirm_ok btn small marsh" onclick="UProfile.purchase(); return false;">OK</button>
                            <input type="hidden" name="user_id" id="user_id" value=""/>
                            <div class="cl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div style="display:none;">
    	<div id="videoShowModal" class="modal p0 videoShowModal">
    		<div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
    			<div class="cont">
    				<div class="videoBox"></div>
    				{{-- <div class="double_btn">
    								<button class="confirm_close btn small dgrey" onclick="UProfile.cancelVideoModal(); return false;">Close</button>
    								<div class="cl"></div>
    				</div> --}}
    			</div>
    		</div>
    	</div>
	</div>
    <!-- /tab_album -->


   <!--Tab Questions -->

    <!-- =============================================== Tab Questions =============================================== -->

    <a id="tabs-3" class="tab_link tab_a"></a>
    <div class="tab_photos tab_cont">
        {{-- Added By Hassan --}}
        @include('site.user.jobseekerInfoTabs.questions')
    </div>

    <!-- =============================================== Tab Reference =============================================== -->
    
    <a id="tabs-4" class="tab_link tab_a"></a>
    <div class="tab_reference tab_cont pt30px">
        @include('site.user.jobseekerInfoTabs.reference')
    </div>

    @if ($controlsession->count() > 0 || isAdmin())

        <!-- =============================================== Tab History =============================================== -->

        <a id="tabs-5" class="tab_link tab_a"></a>
        <div class="tab_history tab_cont pt30px">
            @include('site.user.jobseekerInfoTabs.history')
        </div>

        <!-- =============================================== Tab Notes =============================================== -->

        <a id="tabs-6" class="tab_link tab_a"></a>
        <div class="tab_notes tab_cont pt30px">
            @include('site.user.jobseekerInfoTabs.addNotes')

        </div>

    @endif
    <!-- =============================================== Tab Interview =============================================== -->

     <a id="tabs-7" class="tab_link tab_a"></a>
    <div class="tab_interviews tab_cont pt30px">
        @include('site.user.jobseekerInfoTabs.interviews')

    </div>

    <!-- =============================================== Tabs End here =============================================== -->

    {{-- Added By Hassan --}}


    </div>

</div>
<!-- /tabs_employer -->

</div>

<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Block Job Seeker?</div>  {{-- Modal in job seeker info page --}}
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="ConfirmBlockJsInJsInfoPage btn small marsh">OK</button>
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

<style type="text/css">
    /*.seeCompletedReference{text-decoration: underline;}*/

a.seeCompletedReference {color: black;text-transform: uppercase;text-decoration: none;letter-spacing: 0.15em;display: inline-block;
  padding: 15px 20px;
  position: relative;
}
a.seeCompletedReference:after {    
  background: none repeat scroll 0 0 transparent;bottom: 0;content: "";display: block;height: 2px;left: 50%;position: absolute;background: black;
  transition: width 0.3s ease 0s, left 0.3s ease 0s;
  width: 0;
}
a.seeCompletedReference:hover:after { width: 100%; left: 0; }
.js_location {font-size: 11px !important;}
div#tabs_profile>ul.tab.customTab { margin-bottom: 15px;}
.item_video .video_link{height: 23% !important;}
/*.jq-selectbox.jqselect.templateSelect { position: revert  !important; }*/


</style>
@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){

 // ========== Function to show Block popup when click on ==========//
 $(document).on('click','#JSBlockBtn',function(){
     var jobseeker_id = $(this).data('jsid');
     console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
     $('#jobSeekerBlockId').val(jobseeker_id);
     $('.double_btn').show();


     $('#confirmJobSeekerBlockModal').modal({
        fadeDuration: 200,
        fadeDelay: 2.5,
        escapeClose: false,
        clickClose: false,
    });
 });

 // ========== Block Employer Ajax call  ==========//
 $(document).on('click','.ConfirmBlockJsInJsInfoPage',function(){
    console.log(' blockJsInJsInfoPage ');
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
                $('.double_btn').hide();

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

$('.cop_text').click(function (e) {
   e.preventDefault();
   var copyText = $('.seeCompletedReference').attr('href');

   document.addEventListener('copy', function(e) {
      e.clipboardData.setData('text/plain', copyText);
      e.preventDefault();
   }, true);

   document.execCommand('copy');
   console.log('Link Copied : ', copyText);
   alert('Link Copied: ' + copyText);
 });


// ======================================== On Change button get interview templates ========================================
    
    $(document).on('click' , ".conductInterview", function(){ 
        var abcdrf = $('.jq-selectbox__select-text').text().trim();
        console.log(abcdrf);  
    });

    

// ======================================== On Change button get interview templates ========================================


});
</script>
@stop

