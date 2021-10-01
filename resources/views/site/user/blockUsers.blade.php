{{-- @extends('site.user.usertemplate') --}}


@extends('web.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">Block Users List</div> --}}

    {{-- @dump($employers) --}}
    {{-- <div class="add_new_job">

        <div class="job_row_heading jobs_filter"></div>

        @if ($blockUsers->count() > 0)
        <div class="employers_list">
        @foreach ($blockUsers as $blockuser)

        @php
        $js = $blockuser->user;
        @endphp

        <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">

            <div class="jobSeeker_box relative dinline_block w100">

            <div class="js_profile w_30p w_box dblock fl_left">
                <div class="js_profile_cont center p10"> --}}
              {{--       @php
                    $profile_image  = asset('images/site/icons/nophoto.jpg');
                    $profile_image_gallery    = $js->profileImage()->first();

                    dump($profile_image_gallery);

                    if ($profile_image_gallery) {
                    $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);

                    $profile_image   = assetGallery2($profile_image_gallery,'small');
                    dump($profile_image);

                    }
                    @endphp --}}
                  {{--   <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
                </div> --}}
           {{--      <div class="js_info center">
                    <div class="js_name"><h4 class="bold">{{$js->name}} {{$js->surname}}</h4></div>
                    <div class="js_status_label">{{$js->statusText}}</div>
                    <div class="js_location">Location: {{$js->city}},  {{$js->state}}, {{$js->country}} </div>
                </div>
            </div>

            <div class="js_info w_70p w_box dblock fl_left"> --}}

               {{--  <div class="js_education js_field">
                    <span class="js_label">Education:</span>
                    @php
                    $qualification_names =  getQualificationNames($js->qualification)
                    @endphp --}}
{{-- 
                    @if(!empty($qualification_names))
                        @foreach ($qualification_names as $qnKey => $qnValue)
                        <span class="qualification dblock">{{$qnValue}}</span>
                        @endforeach
                    @endif
                </div>
                <div class="js_about js_field">
                    <span class="js_label">About me:</span>
                    <p class="js_about_me"> {{$js->about_me}}</p>
                </div>
                <div class="js_interested js_field">
                    <span class="js_label">Interested in:</span>
                    <p>{{$js->interested_in}}</p>
                </div>

                <div class="js_languages js_field">
                    <span class="js_label">Languages:</span>
                    <div class="js_tags dinline_block">
                        @if ($js->language)
                        @foreach ($js->language as $lang)
                            <span class="js_tag">{{getLanguage($lang)}}</span>
                        @endforeach
                        @endif
                    </div>
                </div> --}}

               {{--  <div class="js_languages js_field">
                    <span class="js_label">Hobbies:</span>
                    <div class="js_tags dinline_block">
                        @if ($js->hobbies)
                        @foreach ($js->hobbies as $hobby)
                            <span class="js_tag">{{getHobby($hobby)}}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="js_education js_field">
                    <span class="js_label">Qualification:</span>
                    <div class="qualifType"><i class="fas fa-angle-right qualifiCationBullet"></i>Type:
                                    <span class="qualifTypeSpan">{{$js->qualificationType}}</span>
                    </div> --}}
                    {{-- {{implode(', ', getQualificationNames($js->qualification))}} --}}
{{--                 @php
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
            {{ @dump($likeUsers) --}}
            {{-- <div class="js_actionBtn">
                <a class="empUnBlockUserBtn graybtn jbtn" data-jsid="{{$js->id}}">UnBlock</a>
            </div>

            </div>

        </div>
        @endforeach
        </div>
            @else
                    <h3>You have not blocked anyone</h3>
        @endif

    </div>

<div class="cl"></div>
</div>
 --}}


{{-- <div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal cmodal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">UnBlock User?</div>
            <div class="spinner_loader">
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
            <div class="img_chat">
                <div class="icon">
                    <img src="{{asset('/images/site/icons/icon_pp_sure.png')}}" height="48" alt="">
                </div>
                <div class="msg">Are you sure you wish to continue?</div>
            </div>
            <div class="apiMessage mt20"></div>
            <div class="double_btn">
                <button class="confirm_close btn small dgrey" onclick="UProfile.cancelGalleryConfirm(); return false;">Cancel</button>
                <button class="confirmUnlockEmployer confirm_btn btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>

    </div>
</div>
</div> --}}




{{-- html for block user page --}}
  <section class="row">
                <div class="col-md-12">
                     @if ($blockUsers->count() > 0)
                  <div class="profile profile-section">
                    <h2>Block Users Lists</h2>
                     <div class="row">
                          @foreach ($blockUsers as $blockuser)
                            @php
                            $js = $blockuser->user;
                            @endphp                   
                    <div class="col-sm-12 col-md-6">
                        <div class="job-box-info block-box clearfix">
                          <div class="box-head">
                            <h4>No Match potential</h4>                          
                          </div>
                          <div class="row Block-user-wrapper">
                            <div class="col-md-4 user-images">
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
                                <h6>Rapid Print</h6>
                               <div class="progress-img"> <img src="assests/images/user-progressbar.svg" alt=""></div>
                               <div class="block-progrees-ratio d-block d-md-none  ">
                                  <ul>
                                <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                                <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                              </ul>
                            </div>
                              </div>
                            </div>
                            <div class="col-md-8 user-details">
                              <div class="row blocked-user-about">
                                <h6>About me:</h6>
                                <p>{{$js->about_me}}</p>
                              </div>
                              <div class="row blocked-user-about">
                                <h6>Intrested In:</h6>
                                <p>{{$js->interested_in}}</p>
                              </div>
                              <div class="row blocked-user-about">
                                <h6>Location:</h6>
                                <p>{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                              </div>
                              <div class="row blocked-user-experience">
                                <h6>Industory Experience:</h6>
                               @if(isset($js->industry_experience))
                                    @foreach ($js->industry_experience as $ind)
                                        <ul class="indsutrySelect">
                                             <li> <p>{{getIndustryName($ind)}}</p></li>
                                        </ul>
                                    @endforeach
                                 @endif
                              </div>
            
                            </div>
                          </div>
                          <div class="box-footer clearfix">
                            <div class="block-progrees-ratio d-none d-md-block  user-page-footer">
                              <ul>
                                <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                                <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                              </ul>
                            </div>
                            <button class="unblock-btn"  data-toggle="modal" data-target="#myModal"><i class="fas fa-ban"  ></i>UnBlock</button>                          
                          </div>
                           @endforeach
                       </div>
                     </div> 
                      @else
                    <h3>You have not blocked anyone</h3>
                     @endif
                </div>
              </section>


{{-- modal for unblock user of block page --}}

   <!-- ====================================================================================Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog delete-applications">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <i data-dismiss="modal" class="close-box fa fa-times"></i>                      
                      <h1 class="modal-title"><i class="fas fa-ban trash-icon"></i>UnBlock User</h1> 
                    </div>
                    <div class="modal-body">
                      <strong>Are you sure you wish to continue?</strong>
                    </div>
                    <div class="dual-footer-btn">
                      <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                      <button type="button" class="orange_btn"><i class="fa fa-check"></i>OK</button>
                    </div>
                  </div>
                  
                </div>
              </div>

{{-- end html for block user page --}}

@stop

@section('custom_footer_css')
<link rel="stylesheet" href="{{ asset('css/site/profile.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/site/jquery.modal.min.css')}}"> --}}
@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/jquery.modal.min.js') }}"></script> --}}
<script src="{{ asset('js/site/jquery-ui.js') }}"></script>
<script src="{{ asset('js/site/common.js') }}"></script>
{{-- <script type="text/javascript">
$(document).ready(function() {

 $(document).on('click','.empUnBlockUserBtn',function(){
     var jobseeker_id = $(this).data('jsid');
     console.log('UnBlock user from block user list');
     console.log('jsBlockUserBtn click jobseeker_id = ', jobseeker_id);
     $('#jobSeekerBlockId').val(jobseeker_id);
     $('.modal.cmodal').removeClass('showLoader').removeClass('showMessage');
     $('.double_btn').show();

     $('#confirmJobSeekerBlockModal').modal({
        fadeDuration: 200,
        fadeDelay: 2.5,
        escapeClose: false,
        clickClose: false,
    });
 });

 $(document).on('click','.confirmUnlockEmployer',function(){
    console.log(' confirm_JobSeekerBlock_ok ');
    var jobseeker_id = $('#jobSeekerBlockId').val();

    // $('.confirmJobSeekerBlockModal  .img_chat').html(getLoader('blockJobSeekerLoader'));
    $('.confirmJobSeekerBlockModal').addClass('showLoader');
   // $('.confirmJobSeekerBlockModal  .loader').html(getLoader('blockJobSeekerLoader'));

    var btn = $(this); //
   //  btn.prop('disabled',true);

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        type: 'POST',
        url: base_url+'/ajax/unBlockUser',
        data: {id: jobseeker_id},
        success: function(data){
           // btn.prop('disabled',false);
           $('.confirmJobSeekerBlockModal').removeClass('showLoader').addClass('showMessage');
            if( data.status == 1 ){
                $('.confirmJobSeekerBlockModal .apiMessage').html(data.message);
                $('.jobSeeker_row.js_'+jobseeker_id).remove();

                $('.double_btn').hide();

            }else{
                $('.confirmJobSeekerBlockModal .apiMessage').html(data.error);
            }
        }
    });
});





});
</script> --}}
@stop

