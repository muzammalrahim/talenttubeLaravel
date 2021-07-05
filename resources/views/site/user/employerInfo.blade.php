{{-- @extends('site.user.usertemplate') --}}
@extends('site.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
<div class="newJobCont">
    <div class="head icon_head_browse_matches">Employer's Detail</div>
    {{-- @dump($employers) --}}
    <div class="add_new_job">
        <div class="job_row_heading jobs_filter">
            @php
                $js = $employer;
            @endphp
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
                        <div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>
                        <div class="js_status_label">{{$js->statusText}}</div>
                      {{--   <div class="js_location">Location: {{($js->GeoCity)?($js->GeoCity->city_title):''}},  {{($js->GeoState)?($js->GeoState->state_title):''}}, {{($js->GeoCountry)?($js->GeoCountry->country_title):''}} </div> --}}
                    </div>
                </div>

                <div class="js_info w_70p w_box dblock fl_left">
                   
                    {{-- ============================================= Pie Chart =============================================  --}}
            
                    @include('site.user.match_algo.match_algo')   {{-- site/user/match_algo/match_algo --}}
                    
                    {{-- ============================================= Pie Chart =============================================  --}}
                    
                    <div class="js_about js_field">
                        <span class="js_label">About me:</span><p class="js_about_me"> {{$js->about_me}}</p>
                    </div>

                    <div class="js_interested js_field">
                        <span class="js_label">Interested in:</span><p>{{$js->interested_in}}</p>
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

                <div class="js_actionBtn">
                    <a class="blockEmplyerInEmployerInfoPage graybtn jbtn" data-jsid="{{$js->id}}">Block</a>
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
                <li id="tabs-1_switch" class="switch_tab selected"><a href="#tabs-1" title=""><span>Jobs</span></a></li>
                <li id="tabs-2_switch" class="switch_tab "><a href="#tabs-2" title=""><span>Albums</span></a></li>
                <li id="tabs-3_switch" class="switch_tab "><a href="#tabs-3" title=""><span>Questions</span></a></li>
            </ul>
        </div>
        <div id="tabs_content" class="tabs_content">

            <!-- ======================================================= tab_jobs ======================================================= -->

            <a id="tabs-1" class="tab_link tab_a target"></a>

            @include('site.user.employerInfoTabs.jobs')

            <!-- ======================================================= tab_album ======================================================= -->

            <a id="tabs-2" class="tab_link tab_a "></a>
            
            @include('site.user.employerInfoTabs.album')

            <!-- ======================================================= Questions ======================================================= -->

            <a id="tabs-3" class="tab_link tab_a "></a>
            
            @include('site.user.employerInfoTabs.emp_questions')  {{-- site/user/employerInfoTabs/emp_questions --}}

            {{-- ======================================================= End here ======================================================= --}}
        
        </div>
    </div><!-- /tabs_employer -->

</div>

<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">Block Employer?</div>
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirmEmployerBlockInEmpInfoPage btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>
        <div class="apiMessage"></div>
    </div>
</div>
</div>

<div style="display: none;">
    <div id="jobApplyModal" class="modal p0 jobApplyModal wauto ">
        <div id="job_apply_modal" class="w100 pp_edit_info pp_cont m0">
            <div class="frame">
                {{-- <a class="icon_close" href="#close"><span class="close_hover"></span></a> --}}
                <div class="head m0" id="submitProposal">Submit Proposal</div>
                <input type="hidden" value="" name="openModalJobId" id="openModalJobId" />
                <div class="cont">
                    <div class="css_loader loader_edit_popup">
                        <div class="spinner center">
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                            <div class="spinner-blade"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/site/gallery_popup/lc_lightbox.css') }}">

<style type="text/css">
#submitProposal{
    text-align: center;
    background: white;
    color: #142d69;
    font-size: 20px;
    padding-bottom: 20px;
}
</style>

@stop

@section('custom_js')
<script src="{{ asset('js/site/jquery.modal.min.js') }}"></script>
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/gallery_popup/lc_lightbox.lite.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    // ========== Function to show Block popup when click on ==========//
    $(document).on('click','.blockEmplyerInEmployerInfoPage',function(){
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

    // ================================================ Block Employer Ajax call  ================================================

    $(document).on('click','.confirmEmployerBlockInEmpInfoPage',function(){
        console.log(' confirm_JobSeekerBlock_ok ');
        var jobseeker_id = $('#jobSeekerBlockId').val();

        $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
        var btn = $(this); //
        btn.prop('disabled',true);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/blockEmployer/'+jobseeker_id,
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

    // ================================================ Ajax call to like the employer ================================================

    $(document).on('click','.jsLikeUserBtn',function(){
        var btn = $(this);
        var jobseeker_id = $(this).data('jsid');
        console.log(' jsLikeUserBtn jobseeker_id ', jobseeker_id);
        $(this).html('..');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type: 'POST',
            url: base_url+'/ajax/likeEmployer/'+jobseeker_id,
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

});

</script>
@stop
