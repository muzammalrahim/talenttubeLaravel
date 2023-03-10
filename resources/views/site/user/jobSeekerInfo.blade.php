@extends('web.user.usermaster')
@section('custom_css')
{{-- 
<link rel="stylesheet" href="{{ asset('css/site/jquery-ui.css') }}">
--}}
<link rel="stylesheet" href="{{ asset('css/site/jobs.css') }}">
@stop
@section('content')
{{-- html for job seeker details starts here --}}

 @php
   $js = $jobSeeker;

   @endphp                
   <!-- Top Filter Row -->

   @if (!isAdmin($user))

      {{-- @include('site.user.match_algo.match_algo') --}}

      @php
      $dist = calculate_distance($js, $user);
      $ind_exp = cal_ind_exp($js,$user);
      $compatibility = compatibility($js, $user); 
      $user_compat = $compatibility*20;
      // ========================= excluded 6th question ========================= 
      $emp_questions = json_decode($js->questions , true);
      $user_questions = json_decode($user->questions , true);
      $emp_resident = '';
      $user_resident = '';
      
      if ($emp_questions != null && $user_questions != null) {
         $emp_match = array_slice($emp_questions, 5, 6, true);
         foreach ($emp_match as $key => $value) {
            $emp_resident .= $value;
         }
         $user_match = array_slice($user_questions, 5, 6, true);
         foreach ($user_match as $key => $value) {
            $user_resident .= $value;
         }
      }

      if ($emp_resident == 'no' && $user_resident == 'no') {
         $html = '<h4 class="text-danger bold "> No Match Potential </h4>';
      }
      else if($dist < 50 && !empty($ind_exp)) {
         $html = '<h4 class="text-green bold "> Strong Match Potential </h4>';
      }
      else if($dist < 50 ) {
         $html = '<h4 class="text-orange bold "> Moderate Match Potential  </h4>';

      }
      else if(!empty($ind_exp)){
         $html = '<h4 class="text-orange bold "> Moderate Match Potential  </h4>';
      }
      else{
         $html = '<h4 class="text-danger bold "> No Match Potential </h4>';

      }
      
      @endphp
      
@endif
     
<section class="row">
   <div class="profile profile-section">
      <h2 class="head icon_head_browse_matches">Job Seeker Details</h2>
      <div class="row">
         <div class="col-sm-12 col-md-12 js_{{ $js->id }}">
            <div class="job-box-info employee-details-info block-box clearfix">
               <div class="box-head"> 
                  @if (!isAdmin())
                     {!! $html !!}                       
                  @endif
               </div>
               <div class="row Block-user-wrapper">
                  @php
                  $profile_image  = asset('images/site/icons/nophoto.jpg');
                  $profile_image_gallery    = $js->profileImage()->first();
                  if ($profile_image_gallery) {
                  $profile_image   = assetGallery2($profile_image_gallery,'small');
                  }
                  @endphp

                  <div class="col-md-2 user-images">
                     <div class="block-user-img mx-auto float-none border-0">
                        @php
                        $profile_image  = asset('images/site/icons/nophoto.jpg');
                        $profile_image_gallery    = $js->profileImage()->first();
                        if ($profile_image_gallery) {
                           // $profile_image   = assetGallery($profile_image_gallery->access,$js->id,'',$profile_image_gallery->image);
                           $profile_image   = assetGallery2($profile_image_gallery,'small');
                        }
                        @endphp
                        <img src="{{$profile_image}}" alt="" >
                     </div>

                     <div class="block-user-progresss d-none d-sm-block">
                        <h6 class="pl-1">{{$js->username}}</h6>
                     </div>
                  </div>   

                  <div class="progress-img d-block d-sm-none mt-3"> 
                     <h6 class="text-center">{{$js->company}}</h6>
                     <div class="block-progrees-ratio1 d-md-block p-0">
                     <ul>
                     <li class="mx-2 p-0"><span class="Progress-ratio-icon1">.</span> <span> {{ $user_compat }} % </span> Match </li>
                     <li class="p-0"><span class="Progress-ratio-icon2">.</span> <span> {{ 100-$user_compat }} % </span> Un-Matched</li>
                     </ul>
                     </div>
                    
                  </div>
                  <!--div class="col-md-2">
                     <div class="d-none d-md-block  user-images">
                        <div class="block-user-img">
                           @php
                           $profile_image  = asset('images/site/icons/nophoto.jpg');
                           $profile_image_gallery    = $js->profileImage()->first();
                           if ($profile_image_gallery) {
                           $profile_image   = assetGallery2($profile_image_gallery,'small');
                           }
                           @endphp
                           <img src="{{$profile_image}}" class="w-75" alt="" >
                        </div>
                        
                        <div class="block-user-progress ">
                           <h6 class="text-start">{{$js->username}}</h6>
                           <div class="text-center">
                              
                              @if($js->vidoes->count() > 0)
                              {{-- <i class="fas fa-video js_video_link pointer fa-2x text-center" onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" data-bs-target="#videoShowModal" data-bs-toggle="modal" target="_blank" style="color: #00326F; cursor: pointer;">
                              </i> --}}
                              @endif
                           </div>
                        </div>
                     </div>

                     {{-- mobile view --}}
                     <div class="d-block d-md-none">
                        <div class="d-flex justify-content-between">
                           <div class="w-75">
                              <h2 class="text-start">{{$js->username}}</h2>
                           </div>


                           {{-- <div class="progress-img"> 
                              <img src="assests/images/user-progressbar.svg" alt="">
                           </div> --}}
                           <div>
                              
                              @if($js->vidoes->count() > 0)
                              {{-- <i class="fas fa-video js_video_link pointer fa-2x text-center" onclick="showVideoModalFunction('{{assetVideo($js->vidoes->first())}}')" data-bs-target="#videoShowModal" data-bs-toggle="modal" target="_blank" style="color: #00326F; cursor: pointer;">
                              </i> --}}
                              @endif
                           </div>
                        </div>
                        <div class="block-user-img mx-auto float-none border-0">
                           @php
                           $profile_image  = asset('images/site/icons/nophoto.jpg');
                           $profile_image_gallery    = $js->profileImage()->first();
                           if ($profile_image_gallery) {
                           $profile_image   = assetGallery2($profile_image_gallery,'small');
                           }
                           @endphp
                           <img src="{{$profile_image}}" class="w-75" alt="" >
                        </div>
                        
                     </div>
                  </div-->


                  <div class="col-md-10 user-details">
                        
                        {{-- ========================================== Pie Chart ========================================== --}}

                        @if (!isAdmin($user))
                        <div class="progress-img d-none d-sm-block"> 

                           @include('web.piechart.pie_chart')

                        </div>
                        
                        @endif

                        {{-- ========================================== Pie Chart ========================================== --}}

                     @php
                     
                     @endphp
                     <div class="row blocked-user-about mt-2 pl-3">
                        <h6 class="p-0">Recent Job:</h6>
                        <p><b>{{$js->recentJob}}</b> at <b>{{$js->organHeldTitle}}</b></p>
                     </div>
                     <div class="row blocked-user-about mt-2 pl-3">
                        <h6 class="p-0">About Me:</h6>
                        <p>{{$js->about_me}}</p>
                     </div>
                     <div class="row blocked-user-about mt-2 pl-3">
                        <h6 class="p-0">Interested In:</h6>
                        <p>{{$js->interested_in}}</p>
                     </div>
                     <div class="row blocked-user-about mt-2 pl-3">
                        <h6 class="p-0">Location:</h6>
                        <p>{{$js->city}},  {{$js->state}}, {{$js->country}}</p>
                     </div>
                     <div class="row blocked-user-about mt-2 pl-3">
                        <h6 class="p-0">Salary Range:</h6>
                        <p>{{getSalariesRangeLavel($js->salaryRange)}}</p>
                     </div>
                     <div class="row blocked-user-about mt-2 pl-3">
                        <h6 class="p-0">Qualifications:</h6>

                        @php 
                           $jsQualification = ''; 
                           if ($js->qualificationType == "post_degree") {
                              $jsQualification = 'post graduate degree';
                           }else{
                              $jsQualification = $js->qualificationType;
                           }
                        @endphp
                        
                        <p><span><b>Type:</b></span> <span class="text-capitalize spanStyleofP"> {{remove_underscode($jsQualification)}}</span> </p>
                        @php
                        $qualificationsData =  ($js->qualification)?(getQualificationsData($js->qualification)):(array());
                        @endphp
                        @if(!empty($qualificationsData))
                        <ul class="p-0">
                           @foreach($qualificationsData as $qualification)
                           <li class="QualificationSelect">
                              <p>{{$qualification['title']}}</p>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </div>
                     <div class="row blocked-user-experience mt-2 pl-3">
                        <h6 class="p-0">Industry Experience:</h6>
                        @if(isset($js->industry_experience))
                        <ul class="p-0">
                           @foreach ($js->industry_experience as $ind)
                           <li class="indsutrySelect">
                              <p >{{getIndustryName($ind)}} </p>
                           </li>
                           @endforeach
                        </ul>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="box-footer clearfix">
                  <div class="block-progrees-ratio d-none d-md-block">
                  </div>

                  <div class="block-div">
                  @if (in_array($js->id,$blockUsers))
                        <button class="block-btn" onclick="unblockUser('{{ $js->id }}')" class="unblock-btn" data-toggle="modal" data-target="#unBlockModal"><i class="fas fa-ban"></i> UnBlock</button>
                  @else
                        <button class="block-btn" onclick="blockFunction('{{ $js->id }}')"><i class="fas fa-ban"></i> Block</button>
                  @endif
                  </div>
                  
                  @if (in_array($js->id,$likeUsers))
                     <div class="unlike-div">
                        <button class="unlike-btn" onclick="unlikefunction('{{ $js->id }}')" data-toggle="modal" data-target="#unlikeModal"><i class="fas fa-thumbs-up"> </i> UnLike</button>
                     </div>
                  @else
                     <div class="like-div">
                        <button class="like-btn" onclick="likeFunction('{{ $js->id }}')" data-jsid = "{{ $js->id }}"><i class="fas fa-thumbs-up"></i> Like</button> 
                     </div>
                  @endif


               </div>
            </div>
         </div>
      </div>
      
						<div class="row">
								
							<div class="col-md-12 order-md-1 order-sm-2 first-tap-detail">
							<div class="profile profile-section">
										<ul class="nav nav-tabs" id="Profile-tab" role="tablist">
													<span class="line-tab"></span>
													<li class="nav-item" role="presentation">
																<button class="nav-link active" id="reference-tab" data-bs-toggle="tab" data-bs-target="#reference"
																			type="button" role="tab" aria-controls="job" aria-selected="false">
																<i class="fa fa-circle tab-circle-cross"></i>Reference</button>
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
													@if ($controlsession->count() > 0 || isAdmin())
													@include('site.user.jobseekerInfoTabs.notesAndHistory')
													@endif
													<li class="nav-item" role="presentation">
																<button class="nav-link" id="interview-tab" data-bs-toggle="tab" data-bs-target="#interview"
																			type="button" role="tab" aria-controls="contact" aria-selected="false">
																<i class="fa fa-circle tab-circle-cross"></i>Interview</button>
													</li>
													<li class="nav-item" role="presentation">
																<button class="nav-link" id="online_test-tab" data-bs-toggle="tab" data-bs-target="#online_test"
																			type="button" role="tab" aria-controls="contact" aria-selected="false">
																<i class="fa fa-circle tab-circle-cross"></i>Online Test</button>
													</li>
													<li class="nav-item" role="presentation">
																<button class="nav-link" id="last_login-tab" data-bs-toggle="tab" data-bs-target="#last_login"
																			type="button" role="tab" aria-controls="contact" aria-selected="false">
																<i class="fa fa-circle tab-circle-cross"></i>Last Login</button>
													</li>
										</ul>
										<div class="tab-content employee-details-infomation" id="myTabContent">

													<!-- ======================================================= job tab ======================================================= -->
													
													<div class="tab-pane fade show active job-applied pt-4" id="reference"  role="tabpanel" aria-labelledby="reference-tab">
																<h2>Reference</h2>
																<div class="row">
																			@include('site.user.jobseekerInfoTabs.reference')
																			{{-- site/user/jobseekerInfoTabs/reference --}}
																</div>
													</div>

													<!-- ======================================================= album-tab ======================================================= -->
													
													<div class="album-section tab-pane fade Photos " id="profile" role="tabpanel"
																aria-labelledby="profile-tab">

																@include('site.user.jobseekerInfoTabs.album')

													</div>

													<!-- ======================================================= question tab ======================================================= -->

													<div class="tab-pane fade questions-tab" id="contact"  role="tabpanel" aria-labelledby="contact-tab">
																<h2>Questions</h2>
																<div class="tab_photos tab_cont">
																			@include('site.user.jobseekerInfoTabs.questions')  {{-- site/user/jobseekerInfoTabs/questions --}}
																</div>
													</div>

													@if ($controlsession->count() > 0 || isAdmin())
													<!-- =============================================== Tab History =============================================== -->
													
													<div class="tab-pane fade history-tab pt-4" id="history"  role="tabpanel" aria-labelledby="history-tab">
																<h2>History</h2>
																<div class="tab_photos tab_cont">
																			@include('site.user.jobseekerInfoTabs.history')  {{-- site/user/jobseekerInfoTabs/questions --}}
																</div>
													</div>

													{{-- <a id="tabs-5" class="tab_link tab_a"></a> --}}
													{{-- <div class="tab_history tab_cont pt30px"> --}}
																{{-- @include('site.user.jobseekerInfoTabs.history')  --}}
																{{-- site/user/jobseekerInfoTabs/history --}}
													{{-- </div> --}}
													<!-- =============================================== Tab Notes =============================================== -->
													{{-- <a id="tabs-6" class="tab_link tab_a"></a>
													<div class="tab_notes tab_cont pt30px">
																@include('site.user.jobseekerInfoTabs.addNotes')
													</div> --}}

													<div class="tab-pane fade notes-tab pt-4" id="notes"  role="tabpanel" aria-labelledby="notes-tab">
																<h2>Notes</h2>
																<div class="tab_notes tab_cont">
																			@include('site.user.jobseekerInfoTabs.addNotes')  {{-- site/user/jobseekerInfoTabs/questions --}}
																</div>
													</div>

													<!-- =============================================== Tab Jobs =============================================== -->
													{{-- <a id="tabs-8" class="tab_link tab_a"></a>
													<div class="tab_interviews tab_cont pt30px">
																@include('site.user.jobseekerInfoTabs.jobApplications') 
													</div> --}}

													<div class="tab-pane fade jobs-tab pt-4" id="jobs"  role="tabpanel" aria-labelledby="jobs-tab">
																<h2>Jobs</h2>
																<div class="tab_photos tab_cont">
																			@include('site.user.jobseekerInfoTabs.jobApplications')  {{-- site/user/jobseekerInfoTabs/questions --}}

																</div>
													</div>

													@endif

													<div class="tab-pane fade interview-tab pt-4" id="interview"  role="tabpanel" aria-labelledby="interview">
																<h2>Interviews</h2>
																<div class="tab_interviews tab_cont pt30px">
                                                   @include('site.user.jobseekerInfoTabs.interviews') {{--    site/user/jobseekerInfoTabs/interviews  --}}
                                                   
																</div>
													</div>
													<div class="tab-pane fade online_test-tab pt-4" id="online_test"  role="tabpanel" aria-labelledby="online_test-tab">
																<h2>Online Tests</h2>
																<div class="tab_onlineTest tab_cont pt30px">
																			@include('site.user.jobseekerInfoTabs.onlineTests')
																			{{--    site/user/jobseekerInfoTabs/onlineTests  --}}
																</div>
													</div>
													<div class="tab-pane fade last_login-tab pt-4" id="last_login"  role="tabpanel" aria-labelledby="last_login-tab">
																<h2>Last Login</h2>
																<div class="tab_lastLogin tab_cont pt30px">
																			{{-- @dump($jobSeeker->last_login); --}}
																			<p>
																						{{ \Carbon\Carbon::parse($jobSeeker->last_login)->format('d-M-Y H:i:s') }}
																			</p>
																</div>
													</div>
													<!--======================== end all tabs-->
										</div>
										
							</div>
						</div>
						</div>

						
   </div>

   <!-- ===================================== Modal for block jobseeker =====================================  -->

   {{-- @include('web.modals.block') --}}

   @include('web.modals.show_video')

   @include('web.modals.unblock')
   

   <!-- ===================================== Modal for unlike jobseeker =====================================  -->

   @include('web.modals.unlike')


   
</section>
{{-- html for job seekers details ends here --}}
@stop
@section('custom_footer_css')

<style type="text/css"> 

   @media only screen and (max-width: 479px){
      .sidebaricontoggle {
         top: 4rem !important;
      }
   }

   @media only screen and (min-width: 480px) and (max-width: 991px){
      .sidebaricontoggle {
         top: 5rem !important;
      }
   }

   .spanStyleofP{
      font-size: 16px;
      margin: 0;
      padding: 0;
      color: #9c9ea0!important;
   }
   .video_thumb{
      max-height:200px;
   }
   
</style>

@stop
@section('custom_js')

<script src="{{ asset('js/web/profile.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function(){
   
    // ========== Function to show Block popup when click on ==========//
   
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