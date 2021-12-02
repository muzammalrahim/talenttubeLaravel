{{-- @extends('site.user.usertemplate') --}}
{{-- 
@if ($controlsession->count() > 0)
<div class="adminControl">
        <p>You are in control of <span class="bold">{{$user->name}} </span>, click <a href="{{ route('logoutRouteForAdmin') }}" class="adminLogin" > HERE </a> to end control</p>
</div>
@endif
 --}}
@extends('web.user.usermaster')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop

@section('content')
{{-- <div class="newJobCont">
    <div class="head icon_head_browse_matches">Like Users List</div> --}}

    {{-- @dump($employers) --}}
   {{--  <div class="add_new_job">

        <div class="job_row_heading jobs_filter"></div>

        @if ($likeUsers->count() > 0)
        <div class="employers_list">
        @foreach ($likeUsers as $likeuser) --}}

        {{-- @php

        @dd($likeuser)

        $js = $likeuser->user;


        @endphp --}}

       {{--  <div class="jobSeeker_row dblock js_{{$js->id}} mb20 p20">

            <div class="jobSeeker_box relative dinline_block w100">

            <div class="js_profile w_30p w_box dblock fl_left">
                <div class="js_profile_cont center p10"> --}}
            {{--         @php
                    $profile_image  = asset('images/site/icons/nophoto.jpg');
                    $profile_image_gallery    = $js->profileImage()->first();

                    dump($profile_image_gallery);

                    if ($profile_image_gallery) {
                    $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);

                    $profile_image   = assetGallery2($profile_image_gallery,'small');
                    dump($profile_image);

                    }
                    @endphp --}}
                {{--     <img class="js_photo w100" id="pic_main_img" src="{{$profile_image}}">
                </div>
                <div class="js_info center">
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
                    @endif --}}
              {{--   </div>
                <div class="js_about js_field">
                    <span class="js_label">About me:</span>
                    <p class="js_about_me"> {{$js->about_me}}</p>
                </div>
                <div class="js_interested js_field">
                    <span class="js_label">Interested in:</span>
                    <p>{{$js->interested_in}}</p>
                </div> --}}
{{-- 
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
            </div> --}}
            {{-- @dump($likeUsers) --}}
{{--             <div class="js_actionBtn">
                <a class="jsUnLikeUserBtn graybtn jbtn" data-jsid="{{$js->id}}">UnLike</a>
                <a class="graybtn jbtn" href="{{route('employerInfo', ['id' => $js->id])}}" >View Profile</a>
            </div>

            </div>

        </div>

        @endforeach
        </div>
            @else
                    <h3>You have not liked anyone</h3>
        @endif

    </div>

<div class="cl"></div>
</div>



<div style="display:none;">
<div id="confirmJobSeekerBlockModal" class="modal cmodal p0 confirmJobSeekerBlockModal wauto">
    <div class="pp_info_start pp_alert pp_confirm pp_cont" style="left: 0px; top: 0px; margin: 0;">
        <div class="cont">
            <div class="title">UnLike User?</div>
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
                <button class="confirm_EmpUnlike_ok confirm_btn btn small marsh">OK</button>
                <input type="hidden" name="jobSeekerBlockId" id="jobSeekerBlockId" value=""/>
                <div class="cl"></div>
            </div>
        </div>

    </div>
</div>
</div> --}}

{{-- updated html for like user page --}}


<section class="row">
   <div class="col-md-12">
   @if ($likeUsers->count() > 0)
   <div class="profile profile-section">
      <h2>Like Users Lists</h2>
      <div class="row">
         @foreach ($likeUsers as $likeuser)
         
         @php
         // @dd($likeuser)
         $js = $likeuser->user;
         @endphp

         <div class="col-sm-12 col-md-12 js_{{$js->id}}">
            <div class="job-box-info block-box clearfix">

         
               <div class="box-head">
                  <h4>{{$js->name}} {{$js->surname}}</h4>
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
                        <h6>{{$js->name}} {{$js->surname}}</h6>
        
                     </div>
                  </div>
                  <div class="col-md-8 user-details">
                     <div class="row blocked-user-about">
                        <h6>About me:</h6>
                        <p>{{$js->about_me}}.</p>
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
                           <li>
                              <p>{{getIndustryName($ind)}}</p>
                           </li>
                        </ul>
                        @endforeach
                        @endif
                     </div>
                  </div>
               </div>
               <div class="box-footer unlike-btn-group clearfix">
                  <div class="block-progrees-ratio d-none d-md-block user-page-footer">
                     <ul>
                        <li><span class="Progress-ratio-icon1">.</span> <span>60%</span> Match </li>
                        <li><span class="Progress-ratio-icon2">.</span> <span>40%</span> UnMatch</li>
                     </ul>
                  </div>
                  <button class="unlike-btn" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-down"></i> UnLike</button> 
                  <a  href="{{route('jobSeekerInfo', ['id' => $js->id])}}"><button class="block-btn "> View Profile</button></a>                     
               </div>
            </div>
         </div>
        @endforeach

      </div>
      
   </div>

   @else
      <h3>You have not liked anyone</h3>
      @endif
</section>





{{-- modal for unlike user of like page --}}

<!-- ====================================================================================Modal -->
              
<div class="modal fade" id="unlikeModal" role="dialog">
    <div class="modal-dialog delete-applications">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <i data-dismiss="modal" class="close-box fa fa-times"></i><i ></i>                      
          <h1 class="modal-title"><i class="fas fa-thumbs-down trash-icon"></i>UnLike User</h1>
        </div>
        <div class="modal-body">
          <strong>Are you sure you wish to continue?</strong>
        </div>

        <input type="hidden" id="jobSeekerBlockId" />
        <div class="dual-footer-btn">
          <button type="button" class="btn btn-default black_btn" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
          <button type="button" class="orange_btn" onclick="confirmUnlikeFun()" data-dismiss="modal"><i class="fa fa-check"></i>OK</button>
        </div>
      </div>
      
    </div>
</div>

{{-- Updated html for like user page end  --}}

@stop

@section('custom_footer_css')
@stop

@section('custom_js')
{{-- <script src="{{ asset('js/site/common.js') }}"></script> --}}

<script type="text/javascript">
   
   // ======================================================= unLike user =======================================================
    
   this.unlikefunction = function(user_id){
      console.log(' confirm_JobSeekerBlock_ok ');
      $('#jobSeekerBlockId').val(user_id);
   }

   this.confirmUnlikeFun = function(){
      var jobseeker_id = $('#jobSeekerBlockId').val();
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.ajax({
         type: 'POST',
         url: base_url+'/ajax/unLikeUser',
         data: {id: jobseeker_id},
         success: function(data){
            if( data.status == 1 ){
               $('.js_'+jobseeker_id).remove();
               swal("Good job!", "user unliked Successfully", "success");
            }else{
               $('.confirmJobSeekerBlockModal .apiMessage').html(data.error);
            }
         }
      });
   }

</script>

@stop

