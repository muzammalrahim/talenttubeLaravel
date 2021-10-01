{{-- @extends('site.user.usertemplate') --}}
@extends('web.user.usermaster')

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

<section class="row">
                <div class="col-md-12">
                     @php
                        $js = $employer;
                    @endphp
                  <div class="profile profile-section">
                      <h2>Employers Detail</h2>
                                          
                    <!-- Top Filter Row -->
                      <div class="row">
                        <div class="col-sm-12 col-md-12">
                         <div class="job-box-info employee-details-info block-box clearfix">
                           <div class="box-head">
                             <h4>No Match potential</h4>                          
                           </div>
                           <div class="row Block-user-wrapper">
                             <div class="col-md-2 user-images">
                               <div class="block-user-img ">
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
                                 <img src="{{$profile_image}}" alt="">
                               </div>
                               <div class="block-user-progress ">
                                 <h6>{{$js->name}} {{$js->surname}}</h6>
                                <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                                <div class="block-progrees-ratio d-block d-md-none">
                                   <ul>
                                 <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                                 <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                               </ul>
                             </div>
                               </div>
                             </div>
                             <div class="col-md-10 user-details">
                               <div class="row blocked-user-about">
                                 <h6>About me:</h6>
                                 <p>Offering quality and personalised Merchandise/Garment printing, as well as affordable photobooth and jukebox hire across Sydney.</p>
                               </div>
                               <div class="row blocked-user-about">
                                 <h6>Intrested In:</h6>
                                 <p>Screen Printers, entertainment hire attendants and sales people - WE WANT YOU, AND YOUR FRIENDS</p>
                               </div>
                               <div class="row blocked-user-about">
                                 <h6>Location:</h6>
                                 <p>Offering quality and personalised Merchandise/Garment printing, as well as affordable photobooth and jukebox hire across Sydney.</p>
                               </div>
                               <div class="row blocked-user-experience">
                                 <h6>Industory Experience:</h6>
                                 <p>Trades and Services</p>
                                 <p>Retail and Consumer products</p>
                                 <p>Entertainment and event management</p>
                               </div>
             
                             </div>
                           </div>
                           <div class="box-footer clearfix">
                             <div class="block-progrees-ratio d-none d-md-block">
                               <ul>
                                 <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                                 <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                               </ul>
                             </div>
                             <button class="unblock-btn">
                              <img class="icon-unblock" src="assests/images/UnBlock-icon.png" alt="">
                              <img class="hover-block" src="assests/images/hover-block.svg" alt="">
                             UnBlock</button>                          
                           </div>
                        </div>
                      </div> 

                   </div>
                   <div class="profile">
                      <ul class="nav nav-tabs employee-tab-info" id="Profile-tab" role="tablist">
                      <span class="line-tab"></span>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="job-tab" data-bs-toggle="tab" data-bs-target="#job"
                                type="button" role="tab" aria-controls="job" aria-selected="false">
                                <i class="fa fa-circle tab-circle-cross"></i>Job</button>
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
                         
                      </ul>
                      <div class="tab-content employee-details-infomation" id="myTabContent">
                                  <!--=================job tab ============================ -->
                            <div class="tab-pane fade show active job-applied" id="job"  role="tabpanel" aria-labelledby="job-tab">
                              <h2>Jobs I Have Applied</h2>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                      <div class="job-box-info">
                                        <div class="box-head">
                                          <h4>This is test</h4>
                                          <label>Location:<span> Alexandria, New South Wales, Australia</span></label>
                                          <i class="close-box fa fa-times"></i>
                                        </div>
                                        <div class="job-box-text clearfix">
                                          <div class="text-info-detail clearfix">
                                            <label>Job Type:</label>
                                            <span>Senior Designer</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Experience:</label>
                                            <span>3 year</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Salary:</label>
                                            <span>$500/-</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Submitted:</label>
                                            <span>20-12-2012</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Detailed:</label>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                          </div>
                                          <span class="interview-tag used-tag">Interview</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                      <div class="job-box-info">
                                        <div class="box-head">
                                          <h4>This is test</h4>
                                          <label>Location:<span> Alexandria, New South Wales, Australia</span></label>
                                          <i class="close-box fa fa-times"></i>
                                        </div>
                                        <div class="job-box-text clearfix">
                                          <div class="text-info-detail clearfix">
                                            <label>Job Type:</label>
                                            <span>Senior Designer</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Experience:</label>
                                            <span>3 year</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Salary:</label>
                                            <span>$500/-</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Submitted:</label>
                                            <span>20-12-2012</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Detailed:</label>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                                          </div>
                                          <span class="interview-tag used-tag">Interview</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                      <div class="job-box-info">
                                        <div class="box-head">
                                          <h4>This is test</h4>
                                          <label>Location:<span> Alexandria, New South Wales, Australia</span></label>
                                          <i class="close-box fa fa-times"></i>
                                        </div>
                                        <div class="job-box-text clearfix">
                                          <div class="text-info-detail clearfix">
                                            <label>Job Type:</label>
                                            <span>Senior Designer</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Experience:</label>
                                            <span>3 year</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Salary:</label>
                                            <span>$500/-</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Submitted:</label>
                                            <span>20-12-2012</span>
                                          </div>
                                          <div class="text-info-detail clearfix">
                                            <label>Job Detailed:</label>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                              Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing and typesetting industry. and typesetting industry. </p>
                                          </div>
                                          <span class="pendinginterview-tag used-tag">Pending Interview</span>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                  
                                
                          </div>
                        <!--================== album-tab-->

                        <div class="album-section tab-pane fade Photos " id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <div class=" Gallery">
                              <h2>Photos</h2>
                              <ul>
                                <li class="">
                                  <!-- ============ upload images ============= -->
                                  <div class="album-upload-img field" align="left">
                                    <div class="upload-file">
                                      <i class="fas fa-images"></i>
                                      <span>Upload-photo</span>
                                    </div>
                                    <input type="file" id="files" name="files[]" multiple />
                                  </div>

                                  <!-- =========== end ============== -->
                                </li>
                              </ul>
                            </div>
                        <div class="row Resume">
                            <h2>Resume & Contact Details</h2>
                            <div class="col-md-6 Resume-email"><label>Email:<span>hkhan5028@gmail.com</span></label></div>
                            <div class="col-md-6 Resume-contact"><label>Contact#:<span>+92 337 1234567</span></label></div>
                        </div>

                      <div class="Gallery clearfix">
                        <ul>
                          <li>
                            <section class="multiple-file-pdf" id="mupload5">
                              <div class="file-chooser clearfix">
                                <input type="file" class="file-chooser__input" id="file5" name="file5[]">
                                <button type="button" class="send-btn orange_btn"><i class="fa fa-save"></i>Save</button>
                              </div>
                              <div class="file-uploader__message-area">
                                <!-- <p>Select a file</p> -->

                              </div>

                            </section>
                          </li>
                        </ul>
                    </div>
                    <div class=" Gallery">
                      <h2>Video's</h2>
                      <ul>
                        <li class="">
                          <!-- ============ upload images ============= -->
                          <div class="album-upload-img field" align="left">
                            <div class="upload-file">
                              <i class="fas fa-images"></i>
                              <span>Upload-Video</span>
                            </div>
                            <input type="file" id="files" name="files[]" multiple />
                          </div>

                          <!-- =========== end ============== -->
                        </li>
                      </ul>
                    </div>
                        </div>

                        <!--====================== question tab===========================-->
                        <div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">

                            <h2>Questions</h2>
                              <div class="question-ans">
                                <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                                <div class="panel">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                              </div>
                          <div class="question-ans">
                            <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                            <div class="panel">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                          </div>
                          <div class="question-ans">
                            <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                            <div class="panel">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                          </div>
                          <div class="question-ans">
                            <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                            <div class="panel">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                          </div>
                          <div class="question-ans">
                            <h4 class="accordionone">Are you seeking a graduate programe or internship</h4>
                            <div class="panel">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                          </div>


                        </div>
                        <!--========================end all tabs-->
                      </div>
                   </div>
                   
                </div>
              </section>

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
